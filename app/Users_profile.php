<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_profile extends Model
{

	public $table="users_profiles";
    public function users()
    {

        return $this->belongsTo('App\User','users_id','id');
    }

    public function country()
    {

        return $this->belongsTo('App\Countrie','country_id','num_code');
        
    }


}
