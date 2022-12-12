<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    public function name()
    {
        return $this->year.'"'.$this->division.'"';
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'courses_users')->withPivot('role', 'subject_id')->withTimestamps();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'courses_subjects');
    }

    public function students()
    {
        return $this->users()->where('role', 'student');
    }

    public function teachers()
    {
        return $this->users()->where('role', 'teacher');
    }

    public function preceptor()
    {
        return $this->users()->where('role', 'preceptor');
    }
}
