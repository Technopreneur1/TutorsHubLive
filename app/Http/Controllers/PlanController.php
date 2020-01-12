<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    //

    public function post(Request $request)
    {
        $plan = Plan::create([
            'teacher_id' => auth()->user()->profile->id,
            'discipline_id' => $request['discipline'],
            'level_id' => $request['level'],
            'rate' => $request['rate'],
        ]);
        $discipline = $plan->discipline;
        $level = $plan->level;
        return response()->json(['plan' => $plan]);
    }

    public function getUserPlans()
    {
        $plans = auth()->user()->profile->plans;
        return response()->json(['plans' => $plans]);
    }

    public function destroy(Request $request)
    {
        $plan = auth()->user()->profile->plans->find($request->id)->delete();
        return response()->json(['msg' => 'success']);
    }
    public function update(Request $request)
    {
        $plan = auth()->user()->profile->plans->find($request->id)->update([
            'discipline_id' => $request['discipline'],
            'level_id' => $request['level'],
            'rate' => $request['rate'],
        ]);
        return response()->json(['plan' => $plan]);
    }
}
