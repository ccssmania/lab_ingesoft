<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    protected $fillable = [
        'course_id', 'user_id','logro_id' 
    ];

    protected $table = "informacions";

    public function courses()
    {
        return $this->belongsToMany('App\Courses');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function logros()
    {
        return $this->belongsToMany('App\Logro');
    }
}
