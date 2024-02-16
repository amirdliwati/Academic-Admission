<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $table="students";

    public function applications()
    {

        return $this->hasOne('App\Application','student_id','id'); 
        
    }

    public function educatioals()
    {
        return $this->hasMany('App\Educational_background','student_id','id');
  
    }

    public function programs()
    {
        return $this->hasMany('App\Program','student_id','id');
  
    }

    public function nationality()
    {

        return $this->belongsTo('App\Countrie','nationality_id','num_code');
        
    }

    public function howfindus()
    {

        return $this->belongsTo('App\How_find_us_table','how_find_id','id');
        
    }

    public function student_documents()
    {
        return $this->hasMany('App\Students_document','student_id','id');
  
    }
}
