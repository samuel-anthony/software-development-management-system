<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_menu extends Model
{
    //
    public function scopeDivId($query,$param){
        return $query->whereDivId($param);
    }
    
    public function divisions(){
        return $this->hasMany('App\division','div_id');
    }

    public function menus(){
        return $this->hasMany(menu::class);
    }
}
