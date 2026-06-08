<?php

namespace App\Filament\StoreAdmin\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        DatePicker::make('startDate')
                            ->label('Dari Tanggal'),
                        DatePicker::make('endDate')
                            ->label('Sampai Tanggal'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
