<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('title')
                        ->required(),
                    TextInput::make('slug')
                        ->required(),
                ])->columnSpanFull()->columns(2)->label('Category Details'),
                Section::make([
                    TextInput::make('meta_title')
                        ->required(),
                    Textarea::make('meta_description')
                        ->required()
                        ->columnSpanFull(),
                    Textarea::make('meta_keywords')
                        ->required()
                        ->columnSpanFull(),
                ])->columnSpanFull()->label('Meta Details'),
            ]);
    }
}
