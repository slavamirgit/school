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
            $url = config('app.api') . '/grades/update/' . $this->grade['id'];
            $result = $this->apiRequest('PUT', $url, $this->getOptions($options));
        } else {
            $url = config('app.api') . '/grades/store';
            $result = $this->apiRequest('POST', $url, $this->getOptions($options));
        }

        if ($result['success']) {
            if ($this->grade) {
                $this->saved = true;
                $this->error = null;
            } else {
                $this->redirect(route('grades.edit', $result['data']['id']));
            }
        } else {
            $this->error = $this->parseErrors($result);
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
