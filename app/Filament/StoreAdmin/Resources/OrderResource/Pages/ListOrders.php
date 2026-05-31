<?php

namespace App\Filament\StoreAdmin\Resources\OrderResource\Pages;

use App\Filament\StoreAdmin\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
