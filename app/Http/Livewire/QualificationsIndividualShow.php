<?php

namespace App\Http\Livewire;

use App\Models\Subject;
use Livewire\Component;

class QualificationsIndividualShow extends Component
{
    public $student;
    public $subject = '';
    public $qualifications = [];

    public function subject_change()
    {
        if ($this->subject == '') return;
        $this->qualifications = $this->student->subject_hisQualifications(Subject::find($this->subject), $this->student->lastCourse)->get();
    }

    public function render()
    {
        return view('livewire.qualifications-individual-show');
    }
}
