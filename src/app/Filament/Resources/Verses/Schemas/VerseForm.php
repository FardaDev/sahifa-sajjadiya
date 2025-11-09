<?php

namespace App\Filament\Resources\Verses\Schemas;

use App\Models\Dua;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Unique;

class VerseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('dua_id')
                    ->label(trans('dua.dua'))
                    ->required()
                    ->unique(ignoreRecord: true, modifyRuleUsing: function (Get $get, Unique $rule, $state) {
                        return $rule
                            ->where('dua_id', $state)
                            ->where('order', $get('order'));
                    })
                    ->optionsLimit(5)
                    ->options(Dua::query()->pluck('title', 'id')),

                TextInput::make('order')
                    ->label(trans('verse.order'))
                    ->required()
                    ->unique(ignoreRecord: true, modifyRuleUsing: function (Get $get, Unique $rule, $state) {
                        return $rule
                            ->where('dua_id', $get('dua_id'))
                            ->where('order', $state);
                    })
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(16777215),

                TextArea::make('text')
                    ->label(trans('verse.text'))
                    ->maxLength(65000)
                    ->columnSpanFull()
                    ->required()
                    ->rows(2),

                TextArea::make('translation')
                    ->label(trans('verse.translation'))
                    ->columnSpanFull()
                    ->maxLength(65000)
                    ->required()
                    ->rows(2),
            ]);
    }
}
