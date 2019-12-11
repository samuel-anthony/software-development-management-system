<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    //
    public function users(){
        return $this->belongsTo(User::class);    
    }

    public function role_menus(){
        return $this->belongsTo(role_menu::class);
    }
}
