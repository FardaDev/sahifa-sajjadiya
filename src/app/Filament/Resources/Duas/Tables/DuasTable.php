<?php

namespace App\Filament\Resources\Duas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class DuasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('number', 'asc')
            ->columns([
                TextColumn::make('number')
                    ->label(trans('dua.number'))
                    ->sortable(),

                TextColumn::make('title')
                    ->label(trans('dua.title'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label(trans('dua.description'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
