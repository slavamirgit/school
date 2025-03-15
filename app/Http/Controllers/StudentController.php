<?php

namespace App\Http\Controllers;

use App\Traits\ApiRequests;

class StudentController extends Controller
{
    use ApiRequests;

    public function index()
    {
        $url = config('app.api') . '/students';

        return view('site.students.index', [
            'title' => 'Students',
            'data' => $this->apiRequest('GET', $url, $this->getOptions(['page' => (int)request()->page]))['data'] ?? abort(404)
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
        $url = config('app.api') . '/students/show/' . $id;

        return view('site.students.show', [
            'title' => 'Show Student',
            'student' => $this->apiRequest('GET', $url, $this->getOptions())['data'] ?? abort(404)
        ]);
    }

    public function edit($id)
    {
        $url = config('app.api') . '/students/show/' . $id;

        return view('site.students.edit', [
            'title' => 'Edit Student',
            'student' => $this->apiRequest('GET', $url, $this->getOptions())['data'] ?? abort(404)
        ]);
    }
}
