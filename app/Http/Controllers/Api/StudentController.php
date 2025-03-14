<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StudentResource;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class StudentController extends BaseController
{
    public function index()
    {
        if (Auth::user()->isDirector()) {
            $students = Student::all();
        } else {
            $grades = Auth::user()->grades->pluck('id')->toArray();
            $students = Student::whereIn('grade_id', $grades)->get();
        }

        return $this->sendResponse(StudentResource::collection($students), 'Students retrieved successfully.');
    }

    public function store(Request $request)
    {
        if (Auth::user()->cannot('create', Student::class)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        $validated = $this->validateStudent($request);

        $student = Student::create($validated);

        return $this->sendResponse($student, 'Student created successfully.');
    }

    public function show($id)
    {
        if (!$student = Student::find($id)) {
            return $this->sendError('Not found.', ['error' => 'Student not found.']);
        }

        if (Auth::user()->cannot('view', $student)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        return $this->sendResponse($student, 'Student retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        if (!$student = Student::find($id)) {
            return $this->sendError('Not found.', ['error' => 'Student not found.']);
        }

        if (Auth::user()->cannot('update', $student)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        $validated = $this->validateStudent($request);
        $student->update($validated);

        return $this->sendResponse($student, 'Student updated successfully.');
    }

    public function destroy($id)
    {
        if (!$student = Student::find($id)) {
            return $this->sendError('Not found.', ['error' => 'Student not found.']);
        }

        if (Auth::user()->cannot('delete', $student)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        $student->delete();

        return $this->sendResponse([], 'Student deleted successfully.');
    }

    private function validateStudent($request)
    {
        if (Auth::user()->isDirector()) {
            $in = Rule::in(Grade::all()->pluck('id')->toArray());
        } else {
            $in = Rule::in(Auth::user()->grades->pluck('id')->toArray());
        }

        $validator = Validator::make($request->all(), [
            'grade_id' => ['required', 'integer', $in],
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'sex' => ['required', Rule::in(['M', 'F', 'm', 'f'])],
            'age' => 'required|integer|between:6,19'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors());
        }

        $validated = $validator->validated();
        $validated['sex'] = strtoupper($validated['sex']);

        return $validated;
    }
}
