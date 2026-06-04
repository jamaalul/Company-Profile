<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('excerpt')
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('featured_image')
                    ->image()
                    ->directory('news')
                    ->disk('public'),
                Select::make('type')
                    ->options(['public' => 'Public', 'internal' => 'Internal'])
                    ->default('public')
                    ->required(),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_published')
                    ->required(),
                DateTimePicker::make('published_at'),
                Select::make('author_id')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
