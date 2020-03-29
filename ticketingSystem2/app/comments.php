<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    public function ticket(){
    	 return $this->belongsTo('App\tickets');
    }
}
