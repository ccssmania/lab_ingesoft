<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['user_id','examen_id','score'];

    protected $table = "results";

    public function examen()
    {
        return $this->belongsTo('App\Examen', 'examen_id');
    }
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_test', 'test_id');
    }
}
