<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'pregunta', 'id_pregunta', 'user_id', 'examen_id', 'respuesta_1', 'respuesta_2', 'respuesta_3', 'respuesta_4', 'respuesta_correcta', 'nivel','tipo_pregunta','imagen'
    ];

    protected $table ='test';
    
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_test', 'test_id');
    }

    public function userTest()
    {
        return $this->hasMany('App\UserTest');
    }
    public function examen()
    {
        return $this->belongsToMany('App\Examen');
    }

    
}
