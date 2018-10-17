<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table='clients';
    public $timestamps=false;
    protected $fillable = ['nom', 'Tel','email' ,'adresseId'];
    public function addresse()
    {
        return $this->hasOne('App\Addresse','id','adresseId');
    }
}
