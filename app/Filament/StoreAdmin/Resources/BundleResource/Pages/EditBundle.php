<?php

namespace App\Filament\StoreAdmin\Resources\BundleResource\Pages;

use App\Filament\StoreAdmin\Resources\BundleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBundle extends EditRecord
{
    protected static string $resource = BundleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
