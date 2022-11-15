<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //

    protected $fillable = ['student_id','schedule_code', 'remark', 'ay_code'];

    public $timestamps = false;

    protected $primaryKey = 'rating_id';

    protected $table = 'ratings';



    // public static function isRated($user_id, $sched_id){
    // 	return $this->where('user_id', $user_id)->where('schedule_id', $sched_id)->exists();
    // }

    public function student_name(){
        return $this->setConnection('registrar_gadtc')->hasOne('App\User', 'StudID', 'student_id')
            ->select('StudID', 'StudLName', 'StudFName', 'StudMName');
    }

}
