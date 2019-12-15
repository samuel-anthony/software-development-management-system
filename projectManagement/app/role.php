<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\User','id');    
    }

    public function role_menu(){
        return $this->belongsTo(role_menu::class);
    }
}
