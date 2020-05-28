<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'thumbnail','course_id', 'user_id', 'description'
    ];

    protected $table ='courses';

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_course', 'course_id');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Enrollments');
    }

    public function userCourse()
    {
        return $this->hasMany('App\UserCourse');
    }

    public function examen() {
        return $this->hasOne('App\Examen');
    }
    public function exams(){
        return $this->hasMany('App\Examen');
    }
    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }
    public function logros()
    {
        return $this->hasMany('App\Logro');
    }
    public function cargas()
    {
        return $this->hasMany('App\Carga');
    }
    public function informacions()
    {
        return $this->hasMany('App\Informacion');
    }
    
}
