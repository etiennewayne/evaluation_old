<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
   // use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'registrar_gadtc';
    protected $table ='tblstudhinfo';

    protected $fillable = [
         'StudID', 'username', 'StudLname', 'StudFname', 'StudMname', 'StudSex', 'email', 'password'
    ];

    protected $primaryKey = 'StudID';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	//protected $table = 'vw_users';

    public function student_program(){
        $this->hasOne('App\EnroleeStudent', 'EnrIDNum', 'StudID');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /*protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/
}
