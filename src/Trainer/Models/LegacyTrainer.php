<?php

namespace App\Trainer\Models;

use App\Pokemon\Models\Pokemon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Mongolid\Cursor\CacheableCursor;
use Mongolid\LegacyRecord;

class LegacyTrainer extends LegacyRecord
{
    public $fillable = [
        'name',
        'pokemons'
    ];

    protected $collection = 'trainers';

    public function pokemon(): mixed
    {
        return $this->referencesMany(Pokemon::class, 'pokemons');
    }
}