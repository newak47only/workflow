<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    //
     protected $table="information";
     protected $fillable=['name','cont_name','cont_phone','staff_name','staff_phone','emp_id','currency','investment','industry','content','status','process','appeal'];
     
     //public function info_nego(){
     //	return  $this->hasOne('App\Emp','id','emp_id');
     //}
     public function info_nego(){
     	return  $this->hasOne('App\Negotiation','info_id','id');
     }
     public function info_sta(){
     	return  $this->hasMany('App\Statistics','info_id','id');
     }
     public function info_loader(){
          return  $this->hasMany('App\Uploader','info_id','id');
     }
     public function info_emp(){
          return  $this->hasOne('App\Emp','id','emp_id');
     }
     public function info_ciremp(){
          return  $this->hasOne('App\Emp','id','circule_id');
     }
}
