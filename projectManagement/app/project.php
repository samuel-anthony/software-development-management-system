<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    public $primaryKey = 'proj_id';
    public function client(){
        return $this->belongsTo('App\client','cl_id','cl_id');
    }
    public function progresses(){
        return $this->hasMany('App\progress','proj_id','proj_id');
    }
}
