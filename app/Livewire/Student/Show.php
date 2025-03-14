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
        $url = config('app.api') . '/students/delete/' . $this->student['id'];
        $result = $this->apiRequest('DELETE', $url, $this->getOptions());

        if ($result['success']) {
            redirect()->route('students.index');
        }
    }

    public function render(): View
    {
        return view('livewire.student.show');
    }
}
