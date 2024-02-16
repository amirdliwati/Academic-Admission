<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class How_find_us_table extends Model
{
    public $table="how_find_us_tables";

    public function student()
    {
        return $this->hasMany('App\Student','how_find_id','id');
  
    }
}
