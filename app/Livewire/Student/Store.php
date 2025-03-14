<?php

namespace App\Livewire\Student;

use App\Traits\ApiRequests;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Store extends Component
{
    use ApiRequests;

    #[Locked]
    public $student;
    #[Locked]
    public $error;

    public $saved = false;

    #[Validate]
    public $firstname;
    #[Validate]
    public $lastname;
    #[Validate]
    public $sex;
    #[Validate]
    public $age;
    #[Validate]
    public $grade_id;

    public function mount($student = null): void
    {
        if ($student) {
            $this->student = $student;

            $this->firstname = $student['firstname'];
            $this->lastname = $student['lastname'];
            $this->sex = $student['sex'];
            $this->age = $student['age'];
            $this->grade_id = $student['grade_id'];
        }
    }

    public function save(): void
    {
        $options = $this->validate();

        if ($this->student) {
            $result = $this->apiRequest('PUT', route('api.students.update', $this->student['id']), $this->getOptions($options));
            //$result = $this->apiRequest('PUT', 'https://school.slava.app/api/students/update/' . $this->student['id'], $this->getOptions($options));
        } else {
            $result = $this->apiRequest('POST', route('api.students.store'), $this->getOptions($options));
            //$result = $this->apiRequest('POST', 'https://school.slava.app/api/students/store/', $this->getOptions($options));
        }

        if (isset($result['error'])) {
            $this->error = $result['error'];
        } else {
            if ($this->student) {
                $this->saved = true;
                $this->error = null;
            } else {
                $this->redirect(route('web.students.edit', $result['data']['id']));
            }
        }
    }

    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'sex' => [Rule::in(['M', 'F', 'm', 'f'])],
            'age' => ['required', 'integer', 'min:6', 'max:19'],
            'grade_id' => ['required', 'integer']
        ];
    }

    public function render(): View
    {
        return view('livewire.student.store');
    }
}
