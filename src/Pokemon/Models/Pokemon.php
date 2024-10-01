<?php

namespace App\Pokemon\Models;

use App\Picture\Models\Picture;
use Mongolid\Model\AbstractModel;

    class Pokemon extends AbstractModel
{
    public $fillable = [
        'name',
        'sprites'
    ];

    protected $collection = 'pokemons';

    public function pictures()
    {
        return $this->embedsMany(Picture::class, 'sprites');
    }
}