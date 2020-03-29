<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tickets extends Model
{
    //  public function user(){
    // 	return $this->belongsTo(User::class);
    // }
    // protected $guarded = [];
    protected $table = 'tickets';

    public function comments(){
    	return $this->hasMany('App\comments');

    }

    public function logs2(){
    	return $this->belongsTo('App\logs2');

    }
}
