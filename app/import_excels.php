<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class import_excels extends Model
{
    protected $table='import_excels';

    public  function info(){
        return $this->hasMany('App\info');
    }
}
