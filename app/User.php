<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $table="users"; 

    public function users_profiles()
    {

        return $this->hasOne('App\Users_profile','users_id','id');
        //return $this->hasMany('App\Users_profile','users_id');
        
    }

    public function applications()
    {

        return $this->hasMany('App\Application','user_id','id');   
        
    }

    public function user_notifications()
    {

        return $this->hasMany('App\User_notification','user_id','id');
        
    }

    public function admin_notifications()
    {

        return $this->hasMany('App\Admin_notification','user_id','id');
        
    }


}
