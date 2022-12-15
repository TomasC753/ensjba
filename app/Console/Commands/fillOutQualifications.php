<?php

namespace App\Console\Commands;

use App\Models\Period;
use App\Models\Qualification;
use App\Models\User;
use Illuminate\Console\Command;

class fillOutQualifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:fillOutQualifications {--quantity=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fill the qualifications in the last created phase';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $qualifications_probability = [
            10, 10, 10, 9, 9, 9, 8, 8, 8, 8, 8, 7, 7, 7, 7, 7, 6, 6, 6, 6, 6, 6, 6,
            5, 5, 4, 4, 3, 2, 1,
        ];
        shuffle($qualifications_probability);
        $this->withProgressBar(User::students()->get(), function($student) use ($qualifications_probability){
            $lastCourse = $student->lastCourse;
            $subjects = $lastCourse->subjects;
            $last_period_id = Period::all()->last()->id;
            $number_of_qualifications_to_fill = number_format($this->option('quantity'));

            foreach ($subjects as $subject) {
                $teacher = $student->teacher_in_subject($subject->id);
                for ($i=0; $i < $number_of_qualifications_to_fill; $i++) { 
                    $qualification = new Qualification;
                    $qualification->note = $qualifications_probability[random_int(0, 29)];
                    $qualification->student_id = $student->id;
                    $qualification->teacher_id = $teacher->id;
                    $qualification->course_id = $lastCourse->id;
                    $qualification->period_id = $last_period_id;
                    $qualification->subject_id = $subject->id;
                    $qualification->save();
                }
            }

        });
        $this->info("\nNotas cargadas exitosamente!");

        return Command::SUCCESS;
    }
}
