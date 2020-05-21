<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    protected $table = "users";

    public function role()
    {
        return $this->belongsToMany('App\Role', 'user_role', 'user_id');
    }

    /*public function courses()
    {
        return $this->belongsToMany('App\Course', 'user_course', 'user_id');
    }*/

    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute)
        {
        parent::setAttribute($key, $value);
        }
    }

    public function enrollements()
    {
        return $this->hasMany('App\Enrollments');
    }

    public function userCourse()
    {
        return $this->hasMany('App\UserCourse');
    }

    public function results()
    {
        return $this->hasMany('App\Result');
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

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'enrollments')->where('enrollments.status', 1);
    }

    public function exams()
    {
        return $this->hasManyDeep('App\Examen', ['enrollments', 'App\Course'])->where('enrollments.status', 1);
    }

    public function logs(){
        return $this->hasMany('App\Log');
    }
}
