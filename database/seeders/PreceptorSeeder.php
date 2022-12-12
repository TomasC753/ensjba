<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreceptorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $preceptors = User::factory(50)->create();
        foreach ($preceptors as $preceptor) {
            $preceptor->roles()->attach(3);
            // $courses_ids = Course::all()->random(random_int(1, 3))->pluck('id')->toArray();
            // $ids_with_pivot = [];
            // foreach ($courses_ids as $course_id)
            // {
            //     $ids_with_pivot += ["$course_id" => ['role' => 'preceptor']];
            // }
            // $preceptor->courses()->attach($ids_with_pivot);
        }
    }
}
