<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Writer;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('writer', 'post')->get();
        
        return($comments);
    }
    
    public function show($id)
    {
        $comment = Comment::find($id);

        return response()->json($comment);
    }
    
    public function show_comments($id)
    {
        $post = Post::find($id);

        return $post->comments()->with('writer')->get();
    }

    public function add($writer_id, $post_id, Request $request)
    {
        $writer = Writer::find($writer_id);
        $writer -> comments()-> create([
            'text' => $request->text,
            'time'=>$request->time,
            'post_id' => $post_id
        ]);
    }
    
    public function edit($id, Request $request)
    {
        $comment = Comment::find($id);
        $comment->update([
            'text' => $request->text,
            'time' => $request->time
        ]);
    }

    public function delete($id)
    {
        Comment::find($id)->delete();
        
        return response()->json('Successfully delated');
    }
}
