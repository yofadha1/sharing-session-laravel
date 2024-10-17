<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $posts = Post::all();
            return response()->json(['data' => $posts], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $title = $request->get('title');
            $content = $request->get('content');
            $user_id = $request->get('user_id');

            Post::create(['title' => $title, 'content' => $content, 'user_id' => $user_id]);
            return response()->json(['data' => 'success!'], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $post = Post::find($id);
            if (!$post) throw new \Exception('Post not found', 404);
            return response()->json(['data' => $post], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) throw new \Exception('Post not found', 404);
            $post->update($request->all());
            return response()->json(['data' => 'success!'], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) throw new \Exception('Post not found', 404);
            $post->delete();
            return response()->json(['data' => 'success!'], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
