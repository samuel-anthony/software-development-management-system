<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_menu extends Model
{
    //

    public function scopeRoleId($query,$param){
        return $query->whereRoleId($param);
    }
    
    public function roles(){
        return $this->hasMany(role::class);
    }

    public function menus(){
        return $this->hasMany(menu::class);
    }
}
