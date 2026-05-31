<?php

namespace App\Filament\StoreAdmin\Resources\ProductResource\Pages;

use App\Filament\StoreAdmin\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
