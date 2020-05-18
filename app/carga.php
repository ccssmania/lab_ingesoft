<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carga extends Model
{
    protected $fillable = [
        'course_id','user_id', 'pregreso'
    ];

    protected $table = "cargas";

    public function courses()
    {
        return $this->belongsToMany('App\Courses');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
