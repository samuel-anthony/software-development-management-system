<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','div_id','phone','user_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeId($query,$param){
        return $query->whereId($param);
    }

    public function division(){
        return $this->hasOne('App\division','div_id','div_id');
    }
    public function reporter(){
        return $this->belongsTo('App\progress','id','reporter_id');
    }
    public function assignee(){
        return $this->belongsTo('App\progress','id','assignee_id');
    }
}
