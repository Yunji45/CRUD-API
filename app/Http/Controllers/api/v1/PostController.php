<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Semua Posts',
            'data' => $post
        ], 200);
    }

    public function store (Request $req)
    {
        $Validator= Validator::make($req ->all(), [
            'title' => 'required',
            'content' => 'required'
        ],
        [
            'title.required' => 'masukan title Post',
            'content.required' => 'masukan content Post',
        ]
    );
    if ($Validator -> fails()){
        return response ->json([
            'success' => false,
            'message' => 'silahkan isi bidang yang kosong',
            'data' => $Validator->errors()
        ],401);
    }else {
        $post = Post::create([
            'title' => $req ->input('title'),
            'content' =>$req ->input('content'),
        ]);
        if ($post ){
            return response -> json([
                'success' => false,
                'message' =>'Post berhasil disimpan'
            ],200);
        }else{
            return response ->json ([
                'success' =>false,
                'message' =>'Post gagal disimpan'
            ],401);
        }
    }
    }
}
