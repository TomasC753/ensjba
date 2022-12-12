<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Role;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = User::factory(700)->create();

        foreach ($students as $student) {
            $student->roles()->attach(1);
            User::where('id', $student->id)->update(['tutor_id' => Tutor::all()->random()->id]);
            $courses_ids = Course::all()->random(random_int(1, 6))->pluck('id')->toArray();
            $ids_with_pivot = [];
            foreach ($courses_ids as $course_id)
            {
                $ids_with_pivot += ["$course_id" => ['role' => 'student']];
            }
            $student->courses()->attach($ids_with_pivot);
        }  
    }
}
