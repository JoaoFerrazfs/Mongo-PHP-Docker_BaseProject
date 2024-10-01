<?php

namespace App\Pokemon\Models;

use App\Picture\Models\LegacyPicture;
use Mongolid\LegacyRecord;

    class LegacyPokemon extends LegacyRecord
{
    public $fillable = [
        'name',
        'sprites'
    ];

    protected $collection = 'pokemons';

    public function pictures()
    {
        return $this->embedsMany(LegacyPicture::class, 'sprites');
    }
}