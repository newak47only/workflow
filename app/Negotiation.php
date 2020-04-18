<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    //
    protected $table="negotiation";
    protected $fillable=['id','info_id','emp_id','currency','investment','status','neg_at','remark','contract_file','report','eaction','daction','director_id','actiontype','result','check','updated_at'];
    public function nego_info(){
     	return  $this->hasOne('App\Information','id','info_id');
     }
    public function emp(){
    return  $this->hasOne('App\Emp','id','emp_id');
     }
    public function demp(){
    return  $this->hasOne('App\Emp','id','director_id');
     }
}
