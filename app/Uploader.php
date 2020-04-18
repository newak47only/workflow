<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uploader extends Model
{
    //
    protected $table="uploader";

    protected $fillable = ['nego_id','emp_id','httpurl','name','filetype','info_id','actiontype'];
    public function upemp(){
          return  $this->hasMany('App\Emp','id','emp_id');
     }
}
