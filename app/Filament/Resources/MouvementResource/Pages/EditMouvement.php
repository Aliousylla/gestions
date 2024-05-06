<?php

namespace App\Filament\Resources\MouvementResource\Pages;

use App\Filament\Resources\MouvementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMouvement extends EditRecord
{
    protected static string $resource = MouvementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
