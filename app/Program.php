<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public $table="programs";

    public function student()
    {

        return $this->belongsTo('App\Student','student_id','id');
        
    }
}
