<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    public $primaryKey = 'cl_id';
    public function projects(){
        return $this->hasMany('App\project','cl_id','cl_id');
    }
}
