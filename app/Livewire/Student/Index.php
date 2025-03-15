<?php

namespace App\Livewire\Student;

use App\Traits\IsIndex;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use IsIndex;
    use WithPagination;

    public function mount(): void
    {
        $this->view = 'livewire.student.index';
    }
}
