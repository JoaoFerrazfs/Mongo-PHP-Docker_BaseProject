<?php

namespace App\Services;

use App\Picture\Models\Picture;
use App\Pokemon\Models\LegacyPokemon;

class LegacyModelService
{
    public static function createPokemon(): LegacyPokemon
    {
        $pokemon = new LegacyPokemon();
        $pokemon->name = 'Pichu' . time();

        $picture1 = new Picture();
        $picture1->url = 'https://google.com';

        $picture2 = new Picture();
        $picture2->url = 'https://google.com';
        $pokemon->embed('sprites',$picture1);

        $pokemon->save();

        return $pokemon;
    }

    public static function deleteFirstPokemon(): bool
    {
        return LegacyPokemon::first()->delete();
    }
}