<?php

namespace App\Http\Controllers;

use App\Traits\ApiRequests;

class GradeController extends Controller
{
    use ApiRequests;

    public function index()
    {
        $url = config('app.api') . '/grades';

        return view('site.grades.index', [
            'title' => 'Grades',
            'data' => $this->apiRequest('GET', $url, $this->getOptions(['page' => (int)request()->page]))['data'] ?? abort(404)
        ]);
    }

    public function create()
    {
        return view('site.grades.create', [
            'title' => 'Create Grade'
        ]);
    }

    public function show($id)
    {
        $showUrl = config('app.api') . '/grades/show/' . $id;
        $studentsUrl = config('app.api') . '/grades/students/' . $id;

        return view('site.grades.show', [
            'title' => 'Show Grade',
            'grade' => $this->apiRequest('GET', $showUrl, $this->getOptions())['data'] ?? abort(404),
            'students' => $this->apiRequest('GET', $studentsUrl, $this->getOptions())['data'] ?? []
        ]);
    }

    public function edit($id)
    {
        $url = config('app.api') . '/grades/show/' . $id;

        return view('site.grades.edit', [
            'title' => 'Edit Grade',
            'grade' => $this->apiRequest('GET', $url, $this->getOptions())['data'] ?? abort(404)
        ]);
    }
}
