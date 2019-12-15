<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class division extends Model
{
    protected $primaryKey = 'div_id';
    //
    public function user(){
        return $this->belongsTo('App\User','div_id');
    }
}
