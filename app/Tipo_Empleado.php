<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Empleado extends Model
{
    public $timestamps = false;
    protected $table = 'Tipo_Empleado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'tipo'
    ];
}
