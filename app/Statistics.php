<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    //
    protected $table="statistics";
    protected $fillable=['info_id','data','emp_id','data_type','year','currency','data_file'];
}
