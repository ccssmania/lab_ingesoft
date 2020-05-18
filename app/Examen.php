<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $fillable = [
        'course_id','user_id','titulo_examen','cantidad'
    ];

    protected $table ='examen';

    public function test()
    {
        return $this->hasMany('App\Test');
    }
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_course', 'course_id');
    }
    public function courses()
    {
        return $this->belongsTo('App\Course','user_course', 'user_id');
    }
    public function results()
    {
        return $this->hasMany('App\Result');
    }
}
