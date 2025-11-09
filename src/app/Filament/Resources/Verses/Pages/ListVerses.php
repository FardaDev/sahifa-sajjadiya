<?php

namespace App\Filament\Resources\Verses\Pages;

use App\Filament\Resources\Verses\VerseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVerses extends ListRecords
{
    protected static string $resource = VerseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
