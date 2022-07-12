<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $comment = Comment::create([
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);

        if($comment) {
            return redirect()->route('posts.show', $request->post_id)->with(['message' => 'Comment added!', 'status' => 'success']);
        } else {
            return redirect()->route('posts.show', $request->post_id)->with(['message' => 'There was a problem adding your comment!', 'status' => 'danger']);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $updated = $comment->update([
            'comment' => $request->comment
        ]);

        if($updated) {
            return redirect()->route('posts.show', $comment->post_id)->with(['message' => 'Comment updated!', 'status' => 'success']);
        } else {
            return redirect()->route('posts.show', $comment->post_id)->with(['message' => 'Encountered a problem while updating your comment!', 'status' => 'danger']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if($comment->delete()) {
            return redirect()->route('posts.show', $comment->post_id)->with(['message' => 'Comment successfully deleted!', 'status' => 'success']);
        } else {
            return redirect()->route('posts.show', $comment->post_id)->with(['message' => 'Comment could not be deleted!', 'status' => 'danger']);
        };
    }
}
