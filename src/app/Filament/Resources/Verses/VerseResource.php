<?php

namespace App\Filament\Resources\Verses;

use App\Filament\Resources\Verses\Pages\CreateVerse;
use App\Filament\Resources\Verses\Pages\EditVerse;
use App\Filament\Resources\Verses\Pages\ListVerses;
use App\Filament\Resources\Verses\Pages\ViewVerse;
use App\Filament\Resources\Verses\Schemas\VerseForm;
use App\Filament\Resources\Verses\Tables\VersesTable;
use App\Models\Verse;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VerseResource extends Resource
{
    protected static ?string $model = Verse::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedViewColumns;

    public static function getModelLabel(): string
    {
        return trans('verse.verse');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('verse.verses');
    }

    public static function form(Schema $schema): Schema
    {
        return VerseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VersesTable::configure($table);
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
            'index' => ListVerses::route('/'),
            'create' => CreateVerse::route('/create'),
            'view' => ViewVerse::route('/{record}'),
            'edit' => EditVerse::route('/{record}/edit'),
        ];
    }
}
