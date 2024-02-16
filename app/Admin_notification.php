<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin_notification extends Model
{
    public $table="admin_notifications";

    public function application()
    {

        return $this->belongsTo('App\Application','application_id','id');
        
    }

    public function user()
    {

        return $this->belongsTo('App\User','user_id','id');
        
    }
}
