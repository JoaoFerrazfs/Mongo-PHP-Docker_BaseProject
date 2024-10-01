<?php

namespace App\Pokemon\Controller;

use App\Pokemon\Models\LegacyPokemon;
use App\Pokemon\Models\Pokemon;
use App\Services\LegacyModelService;
use App\Services\NewModelService;
use Exception;

class PokemonController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $this->testLegacyModel();
        $this->testNewModel();
    }

    private function testNewModel(): void
    {
        NewModelService::createPokemon();

        if(!Pokemon::first()){
            throw new Exception('method: first - No pokemon found');
        }

        $pokemon = Pokemon::all();
        if(!$pokemon->first()){
            throw new Exception('method: all - No pokemon found');
        }

        /**
         * @var Pokemon $pokemon
         */
        $pictures = Pokemon::first()->pictures();
        if(!$pictures->get()->first()){
            throw new Exception('method: embed - No embedded picture');
        }

        $pokemon = Pokemon::first();
        $pokemon->name = 'Feraligator';
        if(!$pokemon->update()){
            throw new Exception('method: update - No updated pokemon');
        }

        if(!NewModelService::deleteFirst()){
            throw new Exception('method: delete - No deleted pokemon');
        }
    }

    private function testLegacyModel(): void
    {
        LegacyModelService::createPokemon();

        if(!LegacyPokemon::first()){
            throw new Exception('method: first - No pokemon found');
        }

        $pokemon = LegacyPokemon::all();
        if(!$pokemon->first()){
            throw new Exception('method: all - No pokemon found');
        }

        /**
         * @var LegacyPokemon $pokemon
         */
        $pictures = LegacyPokemon::first()->pictures();
        if(!$pictures->first()){
            throw new Exception('method: embed - No embedded picture');
        }

        $pokemon = LegacyPokemon::first();
        $pokemon->name = 'Feraligator';
        if(!$pokemon->update()){
            throw new Exception('method: update - No updated pokemon');
        }

        if(!LegacyModelService::deleteFirstPokemon()){
            throw new Exception('method: delete - No deleted pokemon');
        }
    }
}