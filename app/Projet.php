<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    public $table='projets';
    public $timestamps=false;
    protected $fillable = ['nom', 'description','clientId'];
    public function client()
    {
        return $this->hasOne('App\Client','id','clientId');
    }
}
