<?php

namespace App\Http\Controllers\Administrator\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



use App\Schedule;
use App\EnroleeCourse;

class IncompleteRatingStudentController extends Controller
{
    //
    public function notRated(Request $req){
        
        $data = Schedule::with(['student_list'])
            ->take(3)
            ->get();


        
        return $data;
    }
}
