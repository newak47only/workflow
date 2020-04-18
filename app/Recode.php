<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recode extends Model
{
    //
     protected $table="recode";

    protected $fillable=['info_id','elephant','emp_id','content','mode'];

    public function emp(){
        return $this->hasOne('App\Emp','id','emp_id');
    }

    public function info(){
        return $this->hasOne('App\Information','id','info_id');
    }
}