<?php

namespace App\Livewire\Student;

use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
    public function render(): View
    {
        return view('livewire.student.index')->title('Students');
    }
}
