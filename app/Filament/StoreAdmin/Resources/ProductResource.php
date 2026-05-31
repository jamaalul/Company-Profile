<?php

namespace App\Filament\StoreAdmin\Resources;

use App\Filament\StoreAdmin\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';
    protected static string|\UnitEnum|null $navigationGroup = 'Katalog';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informasi Produk')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image_path')
                            ->image()
                            ->disk('public')
                            ->directory('products')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                        Forms\Components\Toggle::make('is_preorder')
                            ->label('Pre-Order')
                            ->helperText('Tampilkan produk ini sebagai pre-order (bisa ditampilkan meski stok 0)')
                            ->default(false),
                    ])->columns(2),

                Section::make('Custom Fields')
                    ->description('Field tambahan untuk saat checkout (misal: Size, Nama)')
                    ->schema([
                        Forms\Components\Repeater::make('fields')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('field_type')
                                    ->options([
                                        'text' => 'Teks Pendek',
                                        'dropdown' => 'Pilihan (Dropdown)',
                                        'file' => 'Upload File',
                                    ])
                                    ->required()
                                    ->live(),
                                Forms\Components\TagsInput::make('dropdown_options')
                                    ->visible(fn (Get $get) => $get('field_type') === 'dropdown')
                                    ->helperText('Ketik pilihan lalu tekan Enter'),
                                Forms\Components\Toggle::make('is_required')
                                    ->default(true)
                                    ->required(),
                            ])
                            ->orderColumn('sort_order')
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('Tambah Field'),
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
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_preorder')
                    ->label('Pre-Order')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
                Tables\Filters\TernaryFilter::make('is_preorder')->label('Pre-Order'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}