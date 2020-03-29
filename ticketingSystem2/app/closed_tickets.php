<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class closed_tickets extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }
}
