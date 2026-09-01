<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;


class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    Select::make('categories')
                        ->relationship('categories', "title")
                        ->multiple()
                        ->preload()
                        ->createOptionForm([
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
                        ])
                        ->required(),
                    TextInput::make('title')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->required(),
                    TextInput::make('slug')
                        ->required(),
                    RichEditor::make('description')
                        ->required()
                        ->columnSpanFull(),
                    FileUpload::make('image')
                        ->image()
                        ->required(),
                ])->columnSpanFull()->columns(2)->label('Article Details'),
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
