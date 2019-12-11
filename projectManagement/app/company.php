<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    public function scopeCompId($query,$param){
        return $query->whereCompId($param);
    }

    public function projects(){
        return $this->belongsTo(project::class);
    }
}
