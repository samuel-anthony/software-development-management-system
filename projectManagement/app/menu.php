<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model 
{
    public function scopeParentMenuId($query,$param){
        //return $query->where('menu_id','=',$param);
        return $query->whereParentMenuId($param);
    }

    public function role_menus(){
        return $this->belongsTo(role_menu::class);
    }
}
