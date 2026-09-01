<?php

namespace App\Filament\Resources\Advertises\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdvertisesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort("expiry_date", "desc")
            ->columns([
                ImageColumn::make('banner')
                    ->url(fn($record) => $record->redirect_link, true),
                TextColumn::make('expiry_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('company_name')
                    ->searchable(),
                TextColumn::make('contact_no')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
