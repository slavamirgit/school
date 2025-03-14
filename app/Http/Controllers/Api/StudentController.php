<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class StudentController extends BaseController
{
    public function index()
    {
        if (Auth::user()->cannot('viewAny', Student::class)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        if (Auth::user()->isDirector()) {
            $students = Student::all();
        } else {
            $grades = Auth::user()->grades->pluck('id')->toArray();
            $students = Student::whereIn('grade_id', $grades)->with('grade')->get();
        }

        return $this->sendResponse('Students retrieved successfully.', StudentResource::collection($students));
    }

    public function store(Request $request)
    {
        if (Auth::user()->cannot('create', Student::class)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        $validated = $this->validateStudent($request);
        $student = Student::create($validated);

        return $this->sendResponse('Student created successfully.', $student);
    }

    public function show($id)
    {
        if (!$student = Student::find($id)) {
            return $this->sendError('Student not found.');
        }

        if (Auth::user()->cannot('view', $student)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        return $this->sendResponse('Student retrieved successfully.', $student);
    }

    public function update(Request $request, $id)
    {
        if (!$student = Student::find($id)) {
            return $this->sendError('Student not found.');
        }

        if (Auth::user()->cannot('update', $student)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        $validated = $this->validateStudent($request);
        $student->update($validated);

        return $this->sendResponse('Student updated successfully.', $student);
    }

    public function destroy($id)
    {
        if (!$student = Student::find($id)) {
            return $this->sendError('Student not found.');
        }

        if (Auth::user()->cannot('delete', $student)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        $student->delete();

        return $this->sendResponse('Student deleted successfully.');
    }

    private function validateStudent($request)
    {
        if (Auth::user()->isDirector()) {
            $exist = Rule::exists('grades', 'id');
        } else {
            $exist = Rule::in(Auth::user()->grades->pluck('id')->toArray());
        }

        $validator = Validator::make($request->all(), [
            'grade_id' => ['required', 'integer', $exist],
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'sex' => ['required', Rule::in(['M', 'F', 'm', 'f'])],
            'age' => ['required', 'integer', 'min:6', 'max:19']
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error.', $validator->errors(), 400);
        }

        $validated = $validator->validated();
        $validated['sex'] = strtoupper($validated['sex']);

        return $validated;
    }
}
