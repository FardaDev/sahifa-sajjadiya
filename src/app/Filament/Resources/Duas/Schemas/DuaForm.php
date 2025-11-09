<?php

namespace App\Filament\Resources\Duas\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DuaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->label(trans('dua.number'))
                    ->required()
                    ->numeric()
                    ->maxValue(65000)
                    ->minValue(1)
                    ->unique(ignoreRecord: true),

                TextInput::make('title')
                    ->label(trans('dua.title'))
                    ->required()
                    ->maxLength(120),

                TextArea::make('description')
                    ->maxLength(300)
                    ->label(trans('dua.description'))
                    ->columnSpanFull()
            ]);
    }
}
