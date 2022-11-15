<?php

namespace App\Http\Controllers\Student;

use App\EnroleeCourses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\AcademicYear;


class ScheduleController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:web');

    }


    public function index(){
        //return Auth::user()->StudID;
        return view('student.schedule');
    }



    //AJAX
    public function ajaxSchedule(){
//        $set = DB::connection('mysql')->table('sets')
//            ->where('active', 1)->get();

        $ay = AcademicYear::where('active', 1)->first();
        $code = $ay->ay_code;
        $student_id = Auth::user()->StudID;
//        return EnroleeCourses::with(['schedule', 'course'])
//            ->where('EnrIDNum', $student_id)
//            ->get();

        //query from registrar_gadtc and evaluation database.
        //database must be on the same host (evaluation and registrar_gadtc)
        $data = DB::connection('registrar_gadtc')->table('tblenrdtl'.$code.' as a')
            ->join('tblsched'.$code.' as b', 'a.EnrSchedCode', 'b.SchedCode')
            ->join('tblsubject as c', 'a.EnrSubjCode', 'c.SubjCode')
            ->join('tblenr'.$code.' as d', 'a.EnrIDNum', 'd.EnrIDNum')
            ->join('tblstudhinfo as e', 'a.EnrIDNum', 'e.StudID')
            ->select('a.EnrIDNum', 'a.EnrSchedCode', 'a.EnrSubjCode', 'a.EnrSubjStats',
                'b.SchedTimeFrm', 'b.SchedTimeTo', 'b.SchedDays', 'b.SchedInsCode', 'b.SchedSubjSet',
                'c.SubjName', 'c.SubjDesc', 'c.subjClass',
                'ratings.schedule_code as nSchedule_Code',
                'd.EnrCourse', 'd.EnrYear', 'e.StudLName', 'e.StudFName', 'e.StudMName', 'b.allow_rate',
               DB::raw('(select count(*) from registrar_gadtc.tblenrdtl'.$code.'
                join registrar_gadtc.tblsched'.$code.' on registrar_gadtc.tblenrdtl'.$code.'.EnrSchedCode = registrar_gadtc.tblsched'.$code.'.SchedCode
                where registrar_gadtc.tblenrdtl'.$code.'.EnrIDNum = a.EnrIDNum) as count_courses'),
               DB::raw('(select count(*) from evaluation.ratings where evaluation.ratings.student_id=a.EnrIDNum and evaluation.ratings.ay_code = '.$code.') as count_rated_course'),
            )
            ->leftJoin('evaluation.ratings', function($join){
                $join->on('a.EnrSchedCode', 'ratings.schedule_code')
                    ->on('a.EnrIDNum', 'ratings.student_id');
            })
            ->where('a.EnrIDNum', $student_id)
            ->get();

            // DB::table('ratings')
            //     ->where('ratings.student_id', $student_id)
            //     ->where('ratings.ay_code', $ay->ay_code)

        return $data;
    }

}
