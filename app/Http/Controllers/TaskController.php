<?php

namespace App\Http\Controllers;

use App\Models\TaskModel;
use App\Models\TaskTagsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index($id)
    {
        $data = TaskModel::with('taskTags', 'taskTags.tag')->where('user_id', $id)->get();

        return response()->json([
            'status_code' => 200,
            'message' => 'Data dashboard berhasil diambil',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom :attribute harus diisi',
            'exists' => 'Data :attribute tidak ditemukan',
            'date' => 'Kolom :attribute harus berupa tanggal',
        ];

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required',
            'tags_id' => 'required|exists:tags,id',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Data gagal divalidasi',
                'errors' => $validator->errors()
            ], 400);
        }

        $task = TaskModel::create($request->all());

        $taskTags = TaskTagsModel::create([
            'task_id' => $task->id,
            'tag_id' => $request->tags_id,
            'assigned_by' => $request->user_id,
            'assigned_at' => Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')
        ]);

        return response()->json([
            'status_code' => 200,
            'message' => 'Data task berhasil ditambahkan',
            'data' => $task
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => 'Kolom :attribute harus diisi',
            'exists' => 'Data :attribute tidak ditemukan',
            'date' => 'Kolom :attribute harus berupa tanggal',
        ];

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required',
            'tags_id' => 'required|exists:tags,id',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Data gagal divalidasi',
                'errors' => $validator->errors()
            ], 400);
        }

        $task = TaskModel::find($id);

        if (!$task) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data task tidak ditemukan'
            ], 404);
        }

        $task->update($request->all());

        $taskTags = TaskTagsModel::where('task_id', $id)->first();

        $taskTags->update([
            'task_id' => $task->id,
            'tag_id' => $request->tags_id,
            'assigned_by' => $request->user_id,
            'assigned_at' => Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')
        ]);

        return response()->json([
            'status_code' => 200,
            'message' => 'Data task berhasil ditambahkan',
            'data' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = TaskModel::find($id);

        if (!$task) {
            return response()->json([
                'status_code' => 404,
                'message' => 'Data task tidak ditemukan'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Data task berhasil dihapus'
        ], 200);
    }
}
