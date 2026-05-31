<?php

namespace App\Filament\StoreAdmin\Resources;

use App\Filament\StoreAdmin\Resources\BundleResource\Pages;
use App\Models\Bundle;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class BundleResource extends Resource
{
    protected static ?string $model = Bundle::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-gift';
    protected static string|\UnitEnum|null $navigationGroup = 'Katalog';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informasi Bundle')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('special_price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_path')
                            ->image()
                            ->disk('public')
                            ->directory('bundles')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ])->columns(2),

                Section::make('Item Bundle')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->required(),
                                Forms\Components\TextInput::make('quantity')
                                    ->required()
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->addActionLabel('Tambah Produk'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('special_price')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Jumlah Item'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBundles::route('/'),
            'create' => Pages\CreateBundle::route('/create'),
            'edit' => Pages\EditBundle::route('/{record}/edit'),
        ];
    }
}
