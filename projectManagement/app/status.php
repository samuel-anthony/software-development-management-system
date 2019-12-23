<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    //
    public function projectDetail(){
        return $this->belongsTo('App\projectDetail','status_id','status_id');
    }
}
