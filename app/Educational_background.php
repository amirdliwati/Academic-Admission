<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educational_background extends Model
{
    public $table="educational_backgrounds";

    public function student()
    {

        return $this->belongsTo('App\Student','student_id','id');
        
    }
}
