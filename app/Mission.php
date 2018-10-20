<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    public $table='missions';
    public $timestamps=false;
    protected $fillable = ['nom', 'description'];
}
