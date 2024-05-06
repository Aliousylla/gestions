<?php

namespace App\Filament\Resources\RetourResource\Pages;

use App\Filament\Resources\RetourResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRetour extends EditRecord
{
    protected static string $resource = RetourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
