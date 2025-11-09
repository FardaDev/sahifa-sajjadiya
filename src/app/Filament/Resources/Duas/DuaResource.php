<?php

namespace App\Filament\Resources\Duas;

use App\Filament\Resources\Duas\Pages\CreateDua;
use App\Filament\Resources\Duas\Pages\EditDua;
use App\Filament\Resources\Duas\Pages\ListDuas;
use App\Filament\Resources\Duas\Schemas\DuaForm;
use App\Filament\Resources\Duas\Tables\DuasTable;
use App\Models\Dua;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DuaResource extends Resource
{
    protected static ?string $model = Dua::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSun;


    /**
     * @return string|null
     */
    public static function getModelLabel(): string
    {
        return trans('dua.dua');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('dua.duas');
    }

    public static function form(Schema $schema): Schema
    {
        return DuaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DuasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDuas::route('/'),
            'create' => CreateDua::route('/create'),
            'edit' => EditDua::route('/{record}/edit'),
        ];
    }

}
