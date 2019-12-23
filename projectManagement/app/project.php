<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    
    public function client(){
        return $this->belongsTo('App\company','cl_id','cl_id');
    }
}
