<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class StudentTable extends Component
{

    use WithPagination;

    public $search = '';
    public $level = '';
    public $course = '';
    public $order_by = '';
    public $desc = false;

    public function render()
    {
        $students = [];
        if (Auth::user()->role_is('administrator'))
        {
            // dd(User::students()->search($this->search, $this->level, $this->course)->get());
            $students = User::students()->search($this->search, $this->level, $this->course);
        }
        if (Auth::user()->role_is('teacher') || Auth::user()->role_is('preceptor'))
        {
            $students = Auth::user()->hisStudents()->search($this->search, $this->level, $this->course);
        }

        $order = $this->desc ? 'DESC':'ASC';
        if ($this->order_by != '') {$students = $students->orderBy($this->order_by, $order); }

        return view('livewire.student-table', ['students' => $students->paginate(10)]);
    }
}
