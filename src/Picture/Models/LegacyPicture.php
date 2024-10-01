<?php

namespace App\Picture\Models;

use Mongolid\LegacyRecord;

class LegacyPicture extends LegacyRecord
{
    protected $collection = null;

    public $fillable = [
        'url',
    ];
}