<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //


    public function post(Request $request)
    {
        $name = '';
        if($request->hasFile('image'))
        {
            $file = $request->image;
            $name = uniqid(true) . 'blog' . rand(99, 9999) . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/blog', $name);
        }

        $post = Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $name,
        ]);
        
        session()->flash('success', "New Blog Post Added");
        return back();
    }
    public function update(Request $request, $id)
    {
        $post = Blog::findOrFail($id);
        if($request->hasFile('image'))
        {
            $file = $request->image;
            $name = uniqid(true) . 'blog' . rand(99, 9999) . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/blog', $name);

            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $name,
            ]);
        }else{
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }

        
        session()->flash('success', "Blog Post Updated");
        return back();
    }
    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        session()->flash('success', "Blog post deleted");
        return back();
    }
}
