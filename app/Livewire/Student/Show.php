<?php

namespace App\Livewire\Student;

use App\Traits\ApiRequests;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Show extends Component
{
    use ApiRequests;

    #[Locked]
    public $student;

    public function mount($student): void
    {
        $this->student = $student;
    }

    public function delete(): void
    {
        $result = $this->apiRequest('DELETE', route('api.students.delete', $this->student['id']), $this->getOptions());
        //$result = $this->apiRequest('DELETE', 'https://school.slava.app/api/students/delete/' . $this->student['id'], $this->getOptions());

        if ($result['success']) {
            redirect()->route('web.students.index');
        }
    }

    public function render(): View
    {
        return view('livewire.student.show');
    }
}
