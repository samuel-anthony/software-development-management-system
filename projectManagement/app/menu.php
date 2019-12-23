<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model 
{
    protected $primaryKey = 'menu_id';
    public function scopeMenuId($query,$param){
        //return $query->where('menu_id','=',$param);
        return $query->whereIn('menu_id',$param);
    }
    
    public function scopeParentMenuId($query,$param){
        //return $query->where('menu_id','=',$param);
        return $query->whereParentMenuId($param);
    }

    public function role_menus(){
        return $this->hasMany('App\role_menu','menu_id','menu_id');
    }
}
