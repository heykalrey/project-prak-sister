<?php

namespace App\Http\Controllers;

use App\Models\TaskModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index($id)
    {
        $data = TaskModel::with('taskTags.tag')->where('user_id', $id)->get();

        return response()->json([
            'status_code' => 200,
            'message' => 'Data dashboard berhasil diambil',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'exists' => 'Kolom :attribute tidak ditemukan.',
            'date' => 'Kolom :attribute harus berupa tanggal.',
        ];

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required',
            'tag_id' => 'required|exists:tags,id'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Validation error',
                'error' => $validator->errors()
            ], 401);
        }

        
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
