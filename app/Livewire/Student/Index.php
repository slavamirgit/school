<?php

namespace App\Livewire\Student;

use App\Traits\IsIndex;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use IsIndex;
    use WithPagination;

    #[Locked]
    public $data;

    public function render(): View
    {
        return view('livewire.student.index', [
            'students' => collect($this->data)->paginate(10)
        ]);
    }
}
