<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'student.index.all',
            'student.index',
            'student.show',
            'student.create',
            'student.update',
            'student.delete',
            'qualification.index.all',
            'qualification.index.students',
            'qualification.index',
            'qualification.show',
            'qualification.create',
            'qualification.update',
            'qualification.delete',
            'absences.index.all',
            'absences.index.students',
            'absences.index',
            'absences.show',
            'absences.create',
            'absences.update',
            'absences.delete',
            'sanctions.index.all',
            'sanctions.index.students',
            'sanctions.index',
            'sanctions.show',
            'sanctions.create',
            'sanctions.update',
            'sanctions.delete',
            'teacher.index',
            'teacher.index.students',
            'teacher.show',
            'teacher.create',
            'teacher.update',
            'teacher.delete',
            'preceptor.index',
            'preceptor.show',
            'preceptor.create',
            'preceptor.update',
            'preceptor.delete',
            'role.index',
            'role.show',
            'role.create',
            'role.update',
            'role.delete',
            'permissions.index',
            'permissions.create',
            'permissions.delete'
        ];
    }
}
