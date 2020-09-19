<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
// use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'brand', 'model', 'productionyear','description',
    ];
}
