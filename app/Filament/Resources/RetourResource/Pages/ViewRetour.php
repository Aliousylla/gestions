<?php

namespace App\Filament\Resources\RetourResource\Pages;

use App\Filament\Resources\RetourResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRetour extends ViewRecord
{
    protected static string $resource = RetourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
