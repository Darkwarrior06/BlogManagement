<?php

namespace App\Http\Controllers;

use App\Models\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function index()
    {
        $writers = Writer::all()->toArray();
        return ($writers);
    }

    public function show($id)
    {
        $writer = Writer::find($id);
        return response()->json($writer);
    }
    
    public function show_posts($id)
    {
        $writer = Writer::find($id);
        
        return $writer->posts()->with('writer', 'categories')->get();
    }
    
    public function add(Request $request)
    {
        $writer = Writer::create([
            'first_name' => $request -> first_name,
            'last_name' => $request -> last_name,
            'email' => $request -> email,
            'password' => $request -> password,
            'gender' => $request -> gender,
            'writer_access' => 1
        ]);
        $writer -> save();
        
        return response()->json('Successfully Registered');
    }

    public function edit($id, Request $request)
    {

        $writer = Writer::find($id);
        $writer->update([
            'first_name' => $request -> first_name,
            'last_name' => $request -> last_name,
            'email' => $request -> email,
            'gender' => $request -> gender,
            'writer_access' => $request -> writer_access
        ]);
        $writer->save();

        return response()->json('Product updated!');
    }

    public function delete($id)
    {
        $writer = Writer::find($id);
        $writer->posts()->delete();
        $writer->comments()->delete();
        Writer::find($id)->delete();

        return response()->json('Successfully delated');
    }
}
