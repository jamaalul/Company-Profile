<?php

namespace App\Filament\StoreAdmin\Resources\BundleResource\Pages;

use App\Filament\StoreAdmin\Resources\BundleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBundles extends ListRecords
{
    protected static string $resource = BundleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
