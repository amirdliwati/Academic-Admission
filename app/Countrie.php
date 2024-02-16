<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countrie extends Model
{

    public $table="countries";
    public function users_profiles()
    {

        return $this->hasMany('App\Users_profile','num_code','id');
        
    }


    public function students()
    {

        return $this->hasMany('App\Student','num_code','id');
        
    }

}
