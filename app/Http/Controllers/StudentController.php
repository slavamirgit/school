<?php

namespace App\Http\Controllers;

use App\Traits\ApiRequests;

class StudentController extends Controller
{
    use ApiRequests;

    public function index()
    {
        return view('site.students.index', [
            'title' => 'Students',
            'data' => $this->apiRequest('GET', route('api.students.index'), $this->getOptions())['data'] ?? []
            //'data' => $this->apiRequest('GET', 'https://school.slava.app/api/students', $this->getOptions())['data'] ?? []
        ]);
    }

    public function create()
    {
        return view('site.students.create', [
            'title' => 'Create Student'
        ]);
    }

    public function show($id)
    {
        return view('site.students.show', [
            'title' => 'Show Student',
            'student' => $this->apiRequest('GET', route('api.students.show', $id), $this->getOptions())['data']
            //'student' => $this->apiRequest('GET', 'https://school.slava.app/api/students/show/' . $id, $this->getOptions())['data']
        ]);
    }

    public function edit($id)
    {
        return view('site.students.edit', [
            'title' => 'Edit Student',
            //'grade' => $this->apiRequest('GET', route('api.grades.show', $id), $this->getOptions())['data']
            //'grade' => $this->apiRequest('GET', 'https://school.slava.app/api/grades/show/' . $id, $this->getOptions())['data']
        ]);
    }
}
