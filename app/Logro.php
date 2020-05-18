<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logro extends Model
{
    protected $fillable = [
        'course_id', 'user_id', 'titulo','imagen'
    ];

    protected $table = "logros";

    public function courses()
    {
        return $this->belongsToMany('App\Courses');
    }
    public function userss()
    {
        return $this->belongsToMany('App\User');
    }
    public function informacions()
    {
        return $this->hasMany('App\Informacion');
    }
}
