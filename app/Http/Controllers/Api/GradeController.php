<?php

namespace App\Http\Controllers\Api;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class GradeController extends BaseController
{
    public function index()
    {
        if (Auth::user()->cannot('viewAny', Grade::class)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        if (Auth::user()->isDirector()) {
            $grades = Grade::orderBy('id')->paginate(10);
        } else {
            $grades = Auth::user()->grades()->orderBy('id')->paginate(10);
        }

        return $this->sendResponse('Grades retrieved successfully.', $grades);
    }

    public function store(Request $request)
    {
        if (Auth::user()->cannot('create', Grade::class)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:grades', 'regex:/^([1-9]|1[0-2])\w$/u']
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error.', $validator->errors(), 400);
        }

        $validated = $validator->validated();

        $grade = Grade::create($validated);

        if (!Auth::user()->isDirector()) {
            $grade->users()->attach(Auth::id());
        }

        return $this->sendResponse('Grade created successfully.', $grade, 201);
    }

    public function show($id)
    {
        if (!$grade = Grade::find($id)) {
            return $this->sendError('Grade not found.');
        }

        if (Auth::user()->cannot('view', $grade)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        return $this->sendResponse('Grade retrieved successfully.', $grade);
    }

    public function update(Request $request, $id)
    {
        if (!$grade = Grade::find($id)) {
            return $this->sendError('Grade not found.');
        }

        if (Auth::user()->cannot('update', $grade)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('grades')->ignore($id), 'regex:/^([1-9]|1[0-2])\w$/u']
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error.', $validator->errors(), 400);
        }

        $validated = $validator->validated();

        $grade->update($validated);

        return $this->sendResponse('Grade updated successfully.', $grade);
    }

    public function destroy($id)
    {
        if (!$grade = Grade::find($id)) {
            return $this->sendError('Grade not found.');
        }

        if (Auth::user()->cannot('delete', $grade)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        $grade->delete();

        return $this->sendResponse('Grade deleted successfully.');
    }

    public function getStudents($id)
    {
        if (!$grade = Grade::find($id)) {
            return $this->sendError('Grade not found.');
        }

        if (Auth::user()->cannot('view', $grade)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        return $this->sendResponse('Students retrieved successfully.', $grade->students);
    }
}
