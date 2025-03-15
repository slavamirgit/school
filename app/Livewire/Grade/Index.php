<?php

namespace App\Livewire\Grade;

use App\Traits\IsIndex;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use IsIndex;
    use WithPagination;

    public function mount(): void
    {
        $this->view = 'livewire.grade.index';
    }
}
