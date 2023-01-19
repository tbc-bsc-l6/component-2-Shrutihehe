<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    public function dashboard(Request $request){
        $name = null;
        $availability = null;
        $sorting = null;
        $subjects = Subject::whereMonth('created_at', Carbon::now()->month);
        if ($request->name){
            $subjects->where('name', 'LIKE', '%'.$request->name.'%');
            $name = $request->name;
        }
        if ($request->availability){
            $subjects->where('exam_availability', (int)$request->availability);
            $availability = $request->availability;
        }
        if ($request->sorting){
            if ($request->sorting == "asc"){
                $subjects->orderBy('id','asc');
            }
            if ($request->sorting == "desc"){
                $subjects->orderBy('id','desc');
            }
            $sorting = $request->sorting;
        }
        $subjects = $subjects->paginate(20);
        return view('dashboard',[
            'subjects' => $subjects,
            'name' => $name,
            'availability' => $availability,
            'sorting' => $sorting,
        ]);
    }
}
