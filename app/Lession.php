<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lession extends Model
{
    protected $fillable = [
        'course_id', 'titulo','contenido'
    ];

    protected $table = "lessions";

    public function courses()
    {
        return $this->belongsToMany('App\Courses');
    }
}
