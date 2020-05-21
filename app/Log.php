<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['name', 'description', 'user_id', 'examen_id'];


    public function exam(){
    	return $this->belongsTo('App\Examen', 'examen_id');
    }
}
