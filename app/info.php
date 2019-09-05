<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class info extends Model
{
    protected $table='infos';
    public  function import_excels(){
        return $this->belongsTo('App\import_excels');
    }
}
