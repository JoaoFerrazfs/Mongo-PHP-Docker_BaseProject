<?php

namespace App\Picture\Models;

use Mongolid\Model\AbstractModel;

class Picture extends AbstractModel
{
    protected $collection = null;

    public $fillable = [
        'url',
    ];
}