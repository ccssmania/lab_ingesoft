<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    protected $fillable = ['user_id', 'examen_id','respuesta'];

    protected $table = "user_test";

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function examen()
    {
        return $this->belongsTo('App\Examen', 'examen_id');
    }
}
