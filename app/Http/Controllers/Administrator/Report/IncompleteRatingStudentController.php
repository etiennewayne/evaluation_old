<?php

namespace App\Http\Controllers\Administrator\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



use App\Schedule;

class IncompleteRatingStudentController extends Controller
{
    //
    public function notRated(Request $req){
        
        // $data = Schedule::with(['students' => function($q){
        //     $q->join('registrar_gadtc.tblstudhinfo', 'registrar_gadtc.tblstudhinfo.StudID', 'evaluation.ratings.student_id');
        // }])
        //     ->take(3)
        //     ->get();
        $data = Schedule::with(['students'])
            ->take(3)
            ->get();

        
        return $data;
    }
}
