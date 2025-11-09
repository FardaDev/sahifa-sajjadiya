<?php

namespace App\Filament\Resources\Verses\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class VersesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('dua.title')
                    ->limit(40)
                    ->label(trans('dua.dua'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('order')
                    ->label(trans('verse.order'))
                    ->sortable(),

                TextColumn::make('text')
                    ->limit(40)
                    ->label(trans('verse.text')),

                TextColumn::make('translation')
                    ->limit(40)
                    ->label(trans('verse.translation')),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
            ]);
    }
}
