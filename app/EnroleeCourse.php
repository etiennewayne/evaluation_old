<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnroleeCourse extends Model
{
    //

    //from infosystem
    protected $connection = 'registrar_gadtc';
    protected $table = 'tblenrdtl221';

     //protected $primaryKey = 'EnrIDNum';

    //protected $fillable = ['student_id', 'schedule_code', 'course_code', 'course_status'];

    public $timestamps = false;

    public function schedule(){
        return $this->hasOne('App\Schedule', 'SchedCode','EnrSchedCode');
    }

    public function course(){
        return $this->hasOne('App\Course', 'SubjCode','EnrSubjCode');
    }

//    public function course(){
//        return $this->hasOneThrough(Course::class, Schedule::class,
//            'EnrSchedCode', 'SubjCode',
//            'EnrSchedCode', 'Sched'
//        );
//    }


    public function student_name(){
        return $this->setConnection('registrar_gadtc')->hasOne('App\User', 'StudID', 'EnrIDNum')
            ->select('StudID', 'StudLName', 'StudFName', 'StudMName')
            ->with('student_program');
    }

}
