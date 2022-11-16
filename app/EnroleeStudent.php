<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnroleeStudent extends Model
{
    //

    protected $connection = 'registrar_gadtc';
    protected $table ='tblenr221';

    // protected $fillable = [];

    protected $primaryKey = 'EnrIDNum';


}
