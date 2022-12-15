<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function student()
    {
        // return $this->users->withPivot('role', 'student');
        return $this->belongsTo(User::class, 'student_id');
    }

    public function teacher()
    {
        // return $this->users->wherePivot('role', 'teacher');
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
