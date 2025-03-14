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
        array_multisort(array_column($students, 'id'), SORT_ASC, $students);
        $this->grade = $grade;
        $this->students = $students;
    }

    public function delete(): void
    {
        $url = config('app.api') . '/grades/delete/' . $this->grade['id'];
        $result = $this->apiRequest('DELETE', $url, $this->getOptions());

        if ($result['success']) {
            redirect()->route('grades.index');
        }
    }

    public function render(): View
    {
        return view('livewire.grade.show');
    }
}
