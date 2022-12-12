<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            'matematica',
            'lengua',
            'biologia',
            'ciencias naturales',
            'ciencias sociales',
            'fisica',
            'tecnologia',
            'quimica',
            'educacion artistica',
            'ingles',
            'informatica',
            'electronica',
            'formacion para la vida y el trabajo',
            'educacion para la salud',
            'educacion fisica',
            'filosofia',
            'ciudadania y politica',
            'gestion',
            'marketing',
            'geografia',
            'historia'
        ];

        foreach ($subjects as $subject) {
            Subject::create([
                'name' => $subject
            ]);
        }
    }
}
