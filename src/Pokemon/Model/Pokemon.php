<?php

namespace App\Trainer\Model;

use Mongolid\Model\AbstractModel;

class Pokemon extends AbstractModel
{
    public $fillable = [
        'name',
        'pictures'
    ];

    protected $collection = 'pokemons';
}