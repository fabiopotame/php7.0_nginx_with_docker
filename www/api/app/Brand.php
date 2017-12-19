<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $table = 'marcas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'marca',
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}