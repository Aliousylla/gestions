<?php

namespace App\Filament\Resources\MagasinResource\Pages;

use App\Filament\Resources\MagasinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMagasin extends EditRecord
{
    protected static string $resource = MagasinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
