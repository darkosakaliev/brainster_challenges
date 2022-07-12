<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('welcome', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()) {
            return view('posts.create')->with('categories', Category::all());
        } else {
            return redirect()->route('login')->with(['message' => 'You have to be a registered user to create a discussion!', 'stat' => 'danger']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id
        ]);

        if($post) {
            return redirect()->route('home')->with(['message' => 'Discussion created!', 'status' => 'success']);
        } else {
            return redirect()->route('home')->with(['message' => 'Encountered a problem while creating a discussion!', 'status' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments = Comment::all();
        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $updated = $post->update([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'category_id' => $request->category_id
        ]);

        if($updated) {
            return redirect()->route('posts.index')->with(['message' => 'Discussion successfully updated!', 'status' => 'success']);
        } else {
            return redirect()->route('posts.index')->with(['message' => 'Discussion could not be updated!', 'status' => 'danger']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->delete()) {
            return redirect()->route('posts.index')->with(['message' => 'Discussion successfully deleted!', 'status' => 'success']);
        } else {
            return redirect()->route('posts.index')->with(['message' => 'Discussion could not be deleted!', 'status' => 'danger']);
        };
    }

    public function showUnapproved() {
        $posts = Post::all()->where('is_approved', 0);
        return view('posts.unapproved', compact('posts'));
    }

    public function approve($post) {
        $approved = Post::where('id', $post)->update([
            'is_approved' => 1
        ]);

        if($approved) {
            return redirect()->route('posts.index')->with(['message' => 'Discussion successfully approved!', 'status' => 'success']);
        } else {
            return redirect()->route('posts.index')->with(['message' => 'Discussion could not be approved!', 'status' => 'danger']);
        }
    }
}
