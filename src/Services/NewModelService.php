<?php

namespace App\Services;

use App\Picture\Models\Picture;
use App\Pokemon\Models\Pokemon;
use App\Trainer\Models\Trainer;

class NewModelService
{
    public static function createTrainer(): Trainer
    {
        /**
         * @var Trainer $trainer
         */
        $trainer = new Trainer();
        $trainer->name = 'Joao';

        $pokemon = NewModelService::createPokemon();;

        $trainer->pokemon()->attachMany([$pokemon]);

        $trainer->save();

        return $trainer;
    }

    public static function createPokemon(): Pokemon
    {
        $pokemon= new Pokemon();
        $pokemon->name = 'Pichu' . time();

        $picture1 = new Picture();
        $picture1->url = 'https://google.com';

        $picture2 = new Picture();
        $picture2->url = 'https://google.com';

        $pokemon->pictures()->addMany([$picture1, $picture2]);

        $pokemon->save();

        return $pokemon;
    }


    public static function deleteFirst(): bool
    {
        return Pokemon::first()->delete();
    }
}