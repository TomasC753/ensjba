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

    public function age()
    {
        return Carbon::parse($this->date_birth)->age;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users');
    }

    public function role_is(String $role_name)
    {
        $roles = $this->roles->pluck('name')->toArray();

        return (in_array($role_name, $roles));
    }

    public function scopeSearch($query, String $search_query = '', String $level = '', String $course = '')
    {  
    //    return $query->whereHas('courses', function($q) use ($role, $search_query, $level, $course) {
    //             $wheres_query = [];
    //             $wheres_query += ['role' => $role];
    //             if ($level != '') { 
    //                 // $wheres_query += ['type' => $level];

    //             }
    //             if (preg_match('/[0-9](\"|\')[A-z](\"|\')/i', $course)) {
    //                 $wheres_query += [
    //                     'year' => preg_replace('/(\"|\')[A-z](\"|\')/i', '', $course),
    //                     'division' => preg_replace('/\W/i', '', preg_replace('/[0-9]/i', '', $course))
    //                 ];
    //             }
    //             // dump($wheres_query);
    //             return $q->where($wheres_query)->where(function ($query) use ($search_query) {
    //                 $query->where('name', 'like', "%$search_query%")
    //                     ->orWhere('lastName', 'like', "%$search_query%")
    //                     ->orWhere('DNI', 'like', "%$search_query%")
    //                     ->orWhere('phone_number', 'like', "%$search_query%")
    //                     ->orWhere('house_phone_number', 'like', "%$search_query%")
    //                     ->orWhere('email', 'like', "%$search_query%");
    //             });
    //     });
        $list_ids = array_unique($query->get()->map(function($student) use ($course, $level){
            $lastCourse = $student->lastCourse();
            if(!$lastCourse) return;
            // if(!$lastCourse->role != 'student');
            if ($level != '' && $lastCourse->type != $level) return;
            if ($course != '' && preg_match('/[0-9](\"|\')[A-z](\"|\')/i', $course))
            {
                if($lastCourse->name() != strtolower($course)) return;
            }
        
            return $student->id;
        })->filter(function ($item){return $item != null;})->toArray());
        
        // return User::whereHas('courses', function($q) use($search_query, $list_ids){
        //     return $q->whereIn('course_id', $list_ids)->where(function($qq) {return $qq->where('role', 'student');})->where(function($sub_q) use ($search_query){
        //         return $sub_q->where('name', 'like', "%$search_query%")
        //                         ->orWhere('lastName', 'like', "%$search_query%")
        //                         ->orWhere('DNI', 'like', "%$search_query%")
        //                         ->orWhere('phone_number', 'like', "%$search_query%")
        //                         ->orWhere('house_phone_number', 'like', "%$search_query%")
        //                         ->orWhere('email', 'like', "%$search_query%");
        //     });
        // });
        return User::whereIn('id', $list_ids)->where(function($sub_q) use ($search_query){
                    return $sub_q->where('name', 'like', "%$search_query%")
                                    ->orWhere('lastName', 'like', "%$search_query%")
                                    ->orWhere('DNI', 'like', "%$search_query%")
                                    ->orWhere('phone_number', 'like', "%$search_query%")
                                    ->orWhere('house_phone_number', 'like', "%$search_query%")
                                    ->orWhere('email', 'like', "%$search_query%");
        });
    }
    // -----------------------------------------------------------------------
    // Metodos para estudiantes
    public function scopeStudents($query)
    {
        return $query->whereHas('roles', function($q){
            return $q->where(['name' => 'student']);
        });
    }

    // public function scopellastCourse($query)
    // {
    //     return $query->courses->last();
    // }

    public function lastCourse()
    {
        if (!$this->role_is('student')){
            throw new Exception('El usuario no es un estudiante');
        }
        
        return $this->belongsToMany(Course::class, 'courses_users')->latest()->withPivot('role', 'subject_id')->withTimestamps()->first();
    }

    public function studentFrom()
    {
        if (!$this->role_is('student')) throw new Exception('El usuario no es un estudiante');

        return $this->lastCourse()->type;
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
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
        $courses = User::find(1)->dictatedCourses()->get();
        $courses_id = [];
        foreach ($courses as $course)
        {
            array_push($courses_id, $course->id);
        }

        return User::whereHas('courses', function ($q) use ($courses_id){
            return $q->whereIn('course_id', $courses_id)->where('role', 'student');
        });
        // return $this->dictatedCourses()->get()->each(function ($course) {return $course->students();});
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
