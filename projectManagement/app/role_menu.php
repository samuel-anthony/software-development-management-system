<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_menu extends Model
{
    //
    public function scopeDivId($query,$param){
        return $query->whereDivId($param);
    }

    public function menus(){
        return $this->belongsTo('App\menu','menu_id','menu_id');
    }

    public function division(){
        return $this->belongsTo('App\division','div_id','div_id');
    }
}
