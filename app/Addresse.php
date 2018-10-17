<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class addresse extends Model
{
    public $table='addresses';
    public $timestamps=false;
    protected $fillable = ['cite', 'codePostal', 'etat','pays','rue'];
    public function clients()
    {
        return $this->hasMany('App\Client');
    }
}
