<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public $table="applications";

    public function user()
    {

        return $this->belongsTo('App\User','user_id','id');
        
    }

    public function student()
    {

        return $this->belongsTo('App\Student','student_id','id');
        
    }

    public function user_notifications()
    {

        return $this->hasMany('App\User_notification','application_id','id');
        
    }

    public function admin_notifications()
    {

        return $this->hasMany('App\Admin_notification','application_id','id');
        
    }

}
