<?php

namespace App\Models;


class Pets
{
    public static function getCategories(): array
    {
        return ['Cat', 'Dog'];
    }
    
    public static function getStatuses(): array
    {
        return ['available', 'pending', 'sold'];
    }
}
