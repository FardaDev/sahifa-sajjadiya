<?php

namespace App\Filament\Resources\Duas\Pages;

use App\Filament\Resources\Duas\DuaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDua extends EditRecord
{
    protected static string $resource = DuaResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
