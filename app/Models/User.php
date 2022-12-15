<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'age'
    ];

    protected $dates = [
        'date_birth'
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_birth)->age;
    }

    // public function age()
    // {
    //     return Carbon::parse($this->date_birth)->age;
    // }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users');
    }

    public function role_is(String $role_name)
    {
        $roles = $this->roles->pluck('name')->toArray();

        return (in_array($role_name, $roles));
    }

    public function scopeSearch($query, String $role, String $search_query = '', String $level = '', String $course = '')
    {  
        if ($role == 'student')
        {
            return $query->whereHas('lastCourse', function($q) use($level, $course) {
                $wheres_query = [];
                if ($level != '') $wheres_query += ['type' => $level];
                if (preg_match('/[0-9](\"|\')[A-z](\"|\')/i', $course)) {
                    $wheres_query += [
                        'year' => preg_replace('/(\"|\')[A-z](\"|\')/i', '', $course),
                        'division' => preg_replace('/\W/i', '', preg_replace('/[0-9]/i', '', $course))
                    ];
                }
                return $wheres_query ? $q->where($wheres_query) : $q; 
            })->where(function($q) use ($search_query) {
                $q->where('name', 'LIKE', "%$search_query%")->orWhere('lastName', 'LIKE', "%$search_query%")->orWhere('email', 'LIKE', "%$search_query%")->orWhere('phone_number', 'LIKE', "%$search_query%")->orWhere('house_phone_number', 'LIKE', "%$search_query%");
            });
        }   
    }
    // -----------------------------------------------------------------------
    // Metodos para estudiantes
    public function scopeStudents($query)
    {
        return $query->whereHas('roles', function($q){
            return $q->where(['name' => 'student']);
        });
    }

    public function lastCourse()
    {
        // if (!$this->role_is('student')){
        //     throw new Exception('El usuario no es un estudiante');
        // }
        
        // return $this->belongsToMany(Course::class, 'courses_users')->latest()->withPivot('role', 'subject_id')->withTimestamps()->first();
        return $this->belongsTo(Course::class, 'lastCourse_id');
    }

    public function studentFrom()
    {
        if (!$this->role_is('student')) throw new Exception('El usuario no es un estudiante');

        return $this->lastCourse->type;
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function teacher_in_subject($subject)
    {
        $lastCourse_id = $this->lastCourse->id;
        return User::whereHas('courses', function ($q) use ($lastCourse_id, $subject){
            $q->where([
                'course_id' => $lastCourse_id,
                'role' => 'teacher',
                'subject_id' => $subject,
            ]);
        })->first();
    }

    public function hisQualifications()
    {
        return $this->hasMany(Qualification::class, 'student_id');
    }

    public function subject_hisQualifications(Subject $subject, Course $course)
    {
        return $this->hasMany(Qualification::class, 'student_id')->where(['subject_id' => $subject->id, 'course_id' => $course->id]);
    }

    public function course_generalAverage()
    {
        # code...
    }

    public function subject_generalAverage(Subject $subject)
    {
        $average = 0;
        $qualifications = $this->subject_hisQualifications($subject, $this->lastCourse)->get();
        foreach($qualifications as $qualification)
        {
            $average += $qualification->note;
        }

        return $average / $qualifications->count();
    }

    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // Metodos para Profesores
    static function teachers()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher');
        });
    }

    public function DictatedCourses()
    {
        return $this->courses()->where('role', 'teacher');
    }

    public function hisStudents()
    {
        $list_ids = $this->DictatedCourses()->get()->pluck('id')->toArray();
        return User::students()->whereHas('lastCourse', function($q) use ($list_ids){
            return $q->whereIn('id', $list_ids);
        });    
    }

    public function subjects_in_course($course)
    {
        $list_ids = $this->courses()->whereHas('teachers', function($q) use ($course){
            return $q->where([
                'course_id' => $course->id,
                'user_id' => User::all()->last()->id
            ]);
        })->pluck('subject_id')->toArray();

        return Subject::whereIn('id', $list_ids);
    }

    public function uploadedQualifications()
    {
        return $this->hasMany(Qualification::class, 'teacher_id');
    }
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subjects_users');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_users')->withPivot('role', 'subject_id')->withTimestamps();
    }

    // public function lastCourse()
    // {
    //     return $this->belongsToMany(Course::class, 'courses_users')->latest()->withPivot('role', 'subject_id')->withTimestamps()->first();
    // }

    public function qualifications()
    {
        return $this->belongsToMany(Qualification::class, 'qualifications_users')->withPivot('role');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function calls_for_attention()
    {
        return $this->hasMany(Call_for_attention::class);
    }
}
