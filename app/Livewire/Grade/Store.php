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

    public $saved = false;

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
        $options = [
            'name' => $this->name
        ];

        if ($this->grade) {
            $result = $this->apiRequest('PUT', route('api.grades.update', $this->grade['id']), $this->getOptions($options));
            //$result = $this->apiRequest('PUT', 'https://school.slava.app/api/grades/update/' . $this->grade['id'], $this->getOptions($options));
        } else {
            $result = $this->apiRequest('PUT', route('api.grades.store'), $this->getOptions($options));
            //$result = $this->apiRequest('POST', 'https://school.slava.app/api/grades/store', $this->getOptions($options));
        }

        if (isset($result['error'])) {
            $this->error = $result['error'];
        } else {
            if ($this->grade) {
                $this->saved = true;
            } else {
                $this->redirect(route('web.grades.edit', $result['data']['id']));
            }
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
