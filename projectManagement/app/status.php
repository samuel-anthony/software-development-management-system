<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    //
    public function project(){
        return $this->belongsTo('App\project','status_id','status_id');
    }
}
