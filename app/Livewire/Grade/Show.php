<?php

namespace App\Livewire\Grade;

use App\Traits\ApiRequests;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Show extends Component
{
    use ApiRequests;

    #[Locked]
    public $grade;
    #[Locked]
    public $students;

    public function mount($grade, $students): void
    {
        $this->grade = $grade;
        $this->students = $students;
    }

    public function delete(): void
    {
        $result = $this->apiRequest('DELETE', 'https://school.slava.app/api/grades/delete/' . $this->grade['id'], $this->getOptions());

        if ($result['success']) {
            redirect()->route('web.grades.index');
        }
    }

    public function render(): View
    {
        return view('livewire.grade.show');
    }
}
