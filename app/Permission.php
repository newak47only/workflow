<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
    protected $table="permission";
     //public $timestamps = false;
    protected $fillable = ['id','permissionname', 'controller', 'action','pid','is_nav'];
    //protected $hidden = [
    //    'remember_token',
    //];


}
