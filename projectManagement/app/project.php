<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    
    public function companies(){
        return $this->hasMany(company::class);
    }
}
