<?php

namespace App\Http\Controllers;

use App\Models\TagsModel;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $data = TagsModel::all();

        return response()->json([
            'status_code' => 200,
            'message' => 'Data berhasil ditampilkan',
            'data' => $data
        ], 200);
    }
}
