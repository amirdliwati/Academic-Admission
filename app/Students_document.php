<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students_document extends Model
{
    public $table="students_documents";

    public function document()
    {

        return $this->belongsTo('App\Document_type','docyment_type','name');
        
    }

    public function student()
    {

        return $this->belongsTo('App\Student','student_id','id');
        
    }
}
