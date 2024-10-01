<?php

namespace App\Trainer\Models;

use App\Pokemon\Models\Pokemon;
use Mongolid\Model\AbstractModel;
use Mongolid\Model\Relations\ReferencesMany;

class Trainer extends AbstractModel
{
    public $fillable = [
        'name',
        'pokemons'
    ];

    protected $collection = 'trainers';

    public function pokemon(): ReferencesMany
    {
        return $this->referencesMany(Pokemon::class, 'pokemons');
    }
}