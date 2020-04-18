<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Emp extends Authenticatable
{
    use Notifiable;

    protected $table="emp";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','workno','dept_id','leave','username','phone','remark'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function dept(){
        return $this->hasOne('App\Dept','id','dept_id');
    }
}
