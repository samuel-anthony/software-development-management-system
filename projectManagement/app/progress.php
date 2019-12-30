<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class progress extends Model
{
    public $primaryKey = 'progress_id';
    public function project(){
        return $this->belongsTo('App\project','proj_id','proj_id');
    }
    public function reporter(){
        return $this->hasOne('App\User','id','reporter_id');
    }
    public function assignee(){
        return $this->hasOne('App\User','id','assignee_id');
    }
}
