<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    protected $table = 'carros';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'modelo',
        'marca',
        'ano',
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