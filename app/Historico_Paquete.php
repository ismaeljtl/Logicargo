<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico_Paquete extends Model
{
    public $timestamps = false;
    protected $table = 'Historico_Paquete';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fechaHora', 
        'estatusPaquete', 
        'Paquete_id'
    ];
}
