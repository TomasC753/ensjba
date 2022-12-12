<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Preceptor;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Tutor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(TutorSeeder::class);
        // Tutor::factory(200)->create();
        $this->call(TeacherSeeder::class);
        // Teacher::factory(50)->create();
        $this->call(PreceptorSeeder::class);
        // Preceptor::factory(20)->create();

        $this->call(CourseSeeder::class);

        $this->call(StudentSeeder::class);
        // Student::factory(200)->create();
    }
}
