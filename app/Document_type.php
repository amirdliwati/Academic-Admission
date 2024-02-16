<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_type extends Model
{
    public $table="document_types";

    public function students_documents()
    {

        return $this->hasMany('App\Students_document','docyment_type','id');
        
    }
}
