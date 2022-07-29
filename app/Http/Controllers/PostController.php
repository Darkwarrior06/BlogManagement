<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Writer;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('categories', 'writer')->get();
        
        return($posts);
    }
    
    public function show($id)
    {
        $post = Post::with('writer', 'categories')->find($id);
        return response()->json($post);
    }

    public function add($id, $category_id, Request $request)
    {
        $writer = Writer::find($id);
        $writer->posts()->create([
            'text' => $request->text,
            'photo' => $request->photo,
            'video' => $request->video,
            'title' => $request->title,
        ]);
        $category = Category::find($category_id);
        $category -> posts() -> attach (Post::orderBy('id', 'desc') -> first() -> id);
    
        return response()->json('Successfully Registered'); 
       
    }
    
    public function edit($id, Request $request)
    {
        $post = Post::find($id);
        $post->update([
            'text' => $request->text,
            'photo' => $request->photo,
            'video' => $request->video,
            'title' => $request->title,
        ]);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->comments()->delete();
        Post::find($id)->delete();
        
        return response()->json('Successfully delated');
    }


}
