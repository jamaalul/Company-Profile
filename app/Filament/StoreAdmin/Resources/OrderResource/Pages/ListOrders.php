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
        return [
            \Filament\Actions\ExportAction::make()
                ->exporter(\App\Filament\Exports\OrderExporter::class)
                ->formats([\Filament\Actions\Exports\Enums\ExportFormat::Csv])
                ->after(function (\Livewire\Component $livewire) {
                    $livewire->redirect(request()->header('Referer'));
                }),
        ];
    }
}
