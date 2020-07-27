<?php

namespace App\Http\Controllers;
use App\Testimonial;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function getTestimonials()
    {
        $testimonials = Testimonial::orderBy('name', 'asc')->get();
        return response()->json(['testimonials' => $testimonials]);
    }

    public function post(Request $request)
    {
        Testimonial::create(['name' => $request->name,'title' => $request->title,'comment' => $request->body,'age' => $request->age]);
        session()->flash('message', 'New Testimonial Added');
        return back();
    }
    public function update(Request $request, $id)
    {
        Testimonial::findOrFail($id)->update(['name' => $request->name,'title' => $request->title,'comment' => $request->body,'age' => $request->age]);
        session()->flash('message', 'Testimonial Updated');
        return back();
    }
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

            $testimonial->delete();
            session()->flash('message', 'Testimonial deleted');
            session()->flash('success', 'Testimonial deleted');
            return back();

    }
}
