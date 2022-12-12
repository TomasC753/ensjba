<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = User::factory(50)->create();
        foreach ($teachers as $teacher) {
            $teacher->roles()->attach(2);
            $teacher->subjects()->attach(Subject::all()->random(3)->pluck('id')->toArray());
            // $courses_ids = Course::all()->random(random_int(1, 3))->pluck('id')->toArray();
            // $ids_with_pivot = [];
            // foreach ($courses_ids as $course_id)
            // {
            //     $ids_with_pivot += ["$course_id" => ['role' => 'teacher', 'subject' => $teacher->subjects()->get()->random()->id]];
            // }
            // $teacher->courses()->attach($ids_with_pivot);
        }
    }
}
