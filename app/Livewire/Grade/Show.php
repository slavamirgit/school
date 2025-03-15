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
    #[Locked]
    public $error;

    public function mount($grade, $students): void
    {
        $this->grade = $grade;
        $this->students = $students;
    }

    public function delete(): void
    {
        $url = config('app.api') . '/grades/delete/' . $this->grade['id'];
        $result = $this->apiRequest('DELETE', $url, $this->getOptions());

        if ($result['success']) {
            redirect()->route('grades.index');
        } else {
            $this->error = $this->parseErrors($result);
        }
    }

    public function render(): View
    {
        return view('livewire.grade.show');
    }
}
