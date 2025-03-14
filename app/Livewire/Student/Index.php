<?php

namespace App\Livewire\Student;

use App\Traits\IsIndex;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use IsIndex;
    use WithPagination;

    public function render(): View
    {
        return view('livewire.student.index', [
            'students' => collect($this->data)->paginate(10)
        ]);
    }
}
