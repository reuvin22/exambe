<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::orderBy('id', 'DESC')
        ->get();
        if(empty($post)){
            return response()->empty();
        }
        return response()->success($post, 'Data Fetched Successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());
        if(!$post){
            return response()->failed('Failed to insert data');
        }else {
            return response()->success($post, 'Data Inserted Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $postId = Post::find($id);
        if(empty($postId)){
            return response()->empty();
        }
        return response()->success($postId, 'Data Fetched Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePost $request, string $id)
    {
        $postId = Post::find($id);
        $update = $postId->update($request->validated());
        if(empty($postId)){
            return response()->empty();
        }
        if(!$update){
            return response()->failed('Failed to Update Data');
        }else {
            return response()->success($postId, 'Data Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postId = Post::find($id);
        $del = $postId->delete();
        if(empty($del)){
            return response()->empty();
        }
        if(!$del){
            return response()->failed('Failed to Delete Post');
        }else {
            return response()->json([
                'status' => 200,
                'message' => 'Data Deleted Successfully'
            ], 200);
        }
    }
}
