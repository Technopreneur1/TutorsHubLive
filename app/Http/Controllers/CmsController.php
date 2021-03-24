<?php

namespace App\Http\Controllers;

use App\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    //
    public function post(Request $request)
    {
        $post = Cms::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        
        session()->flash('success', "New Page Added");
        return back();
    }
    public function update(Request $request, $id)
    {
        $post = Cms::findOrFail($id);
        
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        
        session()->flash('success', "Page Updated");
        return back();
    }
}
