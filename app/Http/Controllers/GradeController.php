<?php

namespace App\Http\Controllers;

use App\Traits\ApiRequests;

class GradeController extends Controller
{
    use ApiRequests;

    public function index()
    {
        return view('site.grades.index', [
            'title' => 'Grades',
            'data' => $this->apiRequest('GET', 'https://school.slava.app/api/grades', $this->getOptions())['data'] ?? []
        ]);
    }

    public function create()
    {
    }

    public function show($id)
    {
        return view('site.grades.show', [
            'title' => 'Show Grade',
            'grade' => $this->apiRequest('GET', 'https://school.slava.app/api/grades/show/' . $id, $this->getOptions())['data'],
            'students' => $this->apiRequest('GET', 'https://school.slava.app/api/grades/students/' . $id, $this->getOptions())['data']
        ]);
    }

    public function edit($id)
    {
        return view('site.grades.edit', [
            'title' => 'Edit Grade',
            'grade' => $this->apiRequest('GET', 'https://school.slava.app/api/grades/show/' . $id, $this->getOptions())['data']
        ]);
    }
}
