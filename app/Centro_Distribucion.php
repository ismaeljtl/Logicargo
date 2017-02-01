<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Centro_Distribucion;

class Centro_Distribucion extends Model
{
    public $timestamps = false;
    protected $table = 'Centro_Distribucion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'direccion', 
        'Sede_id',
        'Ciudad_id'
    ];
}
