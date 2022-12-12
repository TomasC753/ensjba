<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Preceptor;
use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['primario', 'secundario', 'terciario'];
        $years = ['1', '2', '3', '4', '5', '6'];
        $divisions = ['a', 'b', 'c', 'd', 'e', 'f'];
        
        foreach ($types as $type) {
            foreach ($years as $year) {
                foreach ($divisions as $division) {
                   $course = Course::create([
                    'year' => $year,
                    'division' => $division,
                    'type' => $type,
                   ]);
                   $preceptors = Role::find(3)->users->pluck('id')->toArray();
                   $course->preceptor()->attach([$preceptors[array_rand($preceptors)] => ['role' => 'preceptor']]);
                   
                   $course->subjects()->attach(Subject::all()->random(11)->pluck('id'));
                   $subjects = $course->subjects;
                   foreach ($subjects as $subject) {
                        $teachers = $subject->teachers->pluck('id')->toArray();
                        // dump($teachers[array_rand($teachers)]);
                        $course->teachers()->attach([$teachers[array_rand($teachers)] => ['role' => 'teacher', 'subject_id' => $subject->id]]);
                   }
                }
            }
        }

        // foreach (Course::all() as $course) {
        //     foreach ($course->subjects() as $subject) {
        //         $teacher = array_rand($subject->teachers()->pluck('id')->toArray());
        //         $course->teachers()->attach($teacher);
        //     }
        // }

    }
}
