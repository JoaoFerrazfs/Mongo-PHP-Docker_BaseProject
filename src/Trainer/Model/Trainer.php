<?php

namespace App\Trainer\Model;

use Mongolid\Model\AbstractModel;

class Trainer extends AbstractModel
{
    public $fillable = [
        'name',
        'pokemons'
    ];

    protected $collection = 'trainers';

    public function pokemon()
    {
        return $this->embedsMany(Pokemon::class, 'pokemons');
    }
}