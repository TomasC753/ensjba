<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Preceptor;
use App\Models\Role;
use App\Models\Subject;
use App\Models\Tutor;
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
        // $years = ['1', '2', '3', '4', '5', '6'];
        $divisions = ['a', 'b', 'c', 'd', 'e', 'f'];
        
        // foreach ($types as $type) {
        //     foreach ($years as $year) {
        //         foreach ($divisions as $division) {
        //            $course = Course::create([
        //             'year' => $year,
        //             'division' => $division,
        //             'type' => $type,
        //            ]);
        //            $preceptors = Role::find(3)->users->pluck('id')->toArray();
        //            $course->preceptor()->attach([$preceptors[array_rand($preceptors)] => ['role' => 'preceptor']]);
                   
        //            $course->subjects()->attach(Subject::all()->random(11)->pluck('id'));
        //            $subjects = $course->subjects;
        //            foreach ($subjects as $subject) {
        //                 $teachers = $subject->teachers->pluck('id')->toArray();
        //                 // dump($teachers[array_rand($teachers)]);
        //                 $course->teachers()->attach([$teachers[array_rand($teachers)] => ['role' => 'teacher', 'subject_id' => $subject->id]]);
        //            }
        //         }
        //     }
        // }

        foreach ($types as $type) {
            foreach ($divisions as $division)
            {
                $course = Course::create([
                    'year' => '1',
                    'division' => $division,
                    'type' => $type
                ]);
                $preceptor = Role::find(3)->users->random()->id;
                $course->preceptor()->attach([$preceptor => ['role' => 'preceptor']]);

                $subjects = Subject::all()->random(($type == 'primario') ? 7 : 13);
                $course->subjects()->attach($subjects->pluck('id')->toArray());

                foreach($subjects as $subject){
                    $teachers = $subject->teachers->pluck('id')->toArray();
                    $course->teachers()->attach([$teachers[array_rand($teachers)] => ['role' => 'teacher', 'subject_id' => $subject->id]]);
                }
                $students = User::factory(30)->create(['active' => 1, 'lastCourse_id' => $course->id]);
                $ids_with_pivot = [];
                foreach ($students as $student) {
                    User::where(['id' => $student->id])->update([
                        'tutor_id' => Tutor::all()->random()->id,
                        'lastCourse_id' => $course->id,
                    ]);
                    $student->roles()->attach(1);
                    $ids_with_pivot += [$student->id => ['role' => 'student']];
                }
                $course->students()->attach($ids_with_pivot);

            }
        }

    }
}
