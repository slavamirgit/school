<?php

namespace App\Http\Controllers\Api;

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
            $students = Student::with('grade')->paginate(10);
        } else {
            $grades = Auth::user()->grades->pluck('id')->toArray();
            $students = Student::whereIn('grade_id', $grades)->with('grade')->paginate(10);
        }

        // StudentResource::collection($students)
        return $this->sendResponse('Students retrieved successfully.', $students);
    }

    public function store(Request $request)
    {
        if (Auth::user()->cannot('create', Student::class)) {
            return $this->sendError('Access denied.', [401 => 'Unauthorized'], 401);
        }

        $validation = $this->studentValidation($request);

        if (!$validation['success']) {
            return $this->sendError('Validation error.', $validation['errors'], 400);
        }

        $student = Student::create($validation['data']);

        return $this->sendResponse('Student created successfully.', $student, 201);
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

        $validation = $this->studentValidation($request);

        if (!$validation['success']) {
            return $this->sendError('Validation error.', $validation['errors'], 400);
        }

        $student->update($validation['data']);

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

    private function studentValidation($request)
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
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }

        $validated = $validator->validated();
        $validated['sex'] = strtoupper($validated['sex']);

        return [
            'success' => true,
            'data' => $validated
        ];
    }
}
