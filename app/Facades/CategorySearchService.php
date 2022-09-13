<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CategorySearchService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CategorySearchService';
    }    
}