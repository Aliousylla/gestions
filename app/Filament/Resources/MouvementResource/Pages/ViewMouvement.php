<?php

namespace App\Filament\Resources\MouvementResource\Pages;

use App\Filament\Resources\MouvementResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMouvement extends ViewRecord
{
    protected static string $resource = MouvementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
