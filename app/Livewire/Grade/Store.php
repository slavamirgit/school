<?php

namespace App\Livewire\Grade;

use App\Traits\ApiRequests;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    use ApiRequests;

    #[Locked]
    public $grade;
    #[Locked]
    public $error;

    #[Validate]
    public $name;

    public function mount($grade = null): void
    {
        if ($grade) {
            $this->grade = $grade;
            $this->name = $grade['name'];
        }
    }

    public function save(): void
    {
        $result = $this->apiRequest('PUT', 'https://school.slava.app/api/grades/update/' . $this->grade['id'], $this->getOptions([
            'name' => $this->name
        ]));

        if (isset($result['error'])) {
            $this->error = $result['error'];
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'regex:/^([1-9]|1[0-2])\w$/u']
        ];
    }

    public function render(): View
    {
        return view('livewire.grade.store');
    }
}
