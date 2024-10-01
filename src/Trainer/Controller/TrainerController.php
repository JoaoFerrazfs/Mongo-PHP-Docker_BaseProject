<?php

namespace App\Trainer\Controller;

use App\Services\LegacyModelService;
use App\Services\NewModelService;
use App\Trainer\Models\LegacyTrainer;
use App\Trainer\Models\Trainer;
use Exception;

class TrainerController
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
       $this->testLegacyModel();
       $this->testNewModel();
    }

    public function create(): Trainer
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

    public function legacyCreate(): LegacyTrainer
    {
        $trainer = new LegacyTrainer();
        $trainer->name = 'Joao';

        $pokemon = LegacyModelService::createPokemon();
        $trainer->attach('pokemons',$pokemon);
        $trainer->save();
        return $trainer;
    }


    private function testNewModel(): void
    {
        NewModelService::createTrainer();

        $trainer = Trainer::first();
        if(!$trainer){
            throw new Exception('method: first - No trainer found');
        }

        $trainer = Trainer::all();
        if(!$trainer->first()){
            throw new Exception('method: all - No trainer found');
        }

        /**
         * @var Trainer $trainer
         */
        $trainer = Trainer::first();
        $pokemons = $trainer->pokemon();

        if(!$pokemons->get()->first()){
            throw new Exception('method: embed - No related pokemon');
        }

        $trainer = Trainer::first();
        $trainer->name = 'Alice';
        if(!$trainer->update()){
            throw new Exception('method: update - No updated trainer');
        }

        if(!$trainer->delete()){
            throw new Exception('method: delete - No deleted trainer');
        }

        NewModelService::deleteFirst();
    }

    private function testLegacyModel(): void
    {
        $this->legacyCreate();

        $trainer = LegacyTrainer::first();
        if(!$trainer){
            throw new Exception('method: first - No trainer found');
        }

        $trainer = LegacyTrainer::all();
        if(!$trainer->first()){
            throw new Exception('method: all - No trainer found');
        }

        /**
         * @var LegacyTrainer $trainer
         */
        $trainer = LegacyTrainer::first();
        $pokemons = $trainer->pokemon();
        if(!$pokemons->first()){
            throw new Exception('method: embed - No related pokemon');
        }

        $trainer = LegacyTrainer::first();
        $trainer->name = 'Alice';
        if(!$trainer->update()){
            throw new Exception('method: update - No updated trainer');
        }

        if(!$trainer->delete()){
            throw new Exception('method: delete - No deleted trainer');
        }

        LegacyModelService::deleteFirstPokemon();
    }

}