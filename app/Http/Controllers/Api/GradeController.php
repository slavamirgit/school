<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StudentResource;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class GradeController extends BaseController
{
    public function index()
    {
        if (Auth::user()->isDirector()) {
            $grades = Grade::all();
        } else {
            $grades = Auth::user()->grades;
        }

        return $this->sendResponse($grades, 'Grades retrieved successfully.');
    }

    public function store(Request $request)
    {
        if (Auth::user()->cannot('create', Grade::class)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:grades'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors());
        }

        $validated = $validator->validated();

        $grade = Grade::create($validated);

        if (!Auth::user()->isDirector()) {
            $grade->users()->attach(Auth::id());
        }

        return $this->sendResponse($grade, 'Grade created successfully.');
    }

    public function show($id)
    {
        if (!$grade = Grade::find($id)) {
            return $this->sendError('Not found.', ['error' => 'Grade not found.']);
        }

        if (Auth::user()->cannot('view', $grade)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        return $this->sendResponse($grade, 'Grade retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        if (!$grade = Grade::find($id)) {
            return $this->sendError('Not found.', ['error' => 'Grade not found.']);
        }

        if (Auth::user()->cannot('update', $grade)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('grades')->ignore($id)],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors());
        }

        $validated = $validator->validated();

        $grade->update($validated);

        return $this->sendResponse($grade, 'Grade updated successfully.');
    }

    public function destroy($id)
    {
        if (!$grade = Grade::find($id)) {
            return $this->sendError('Not found.', ['error' => 'Grade not found.']);
        }

        if (Auth::user()->cannot('delete', $grade)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        $grade->delete();

        return $this->sendResponse([], 'Grade deleted successfully.');
    }

    public function getStudents($id)
    {
        if (!$grade = Grade::find($id)) {
            return $this->sendError('Not found.', ['error' => 'Grade not found.']);
        }

        if (Auth::user()->cannot('view', $grade)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        return $this->sendResponse(StudentResource::collection($grade->students), 'Students retrieved successfully.');
    }
}
