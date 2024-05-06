<?php

namespace App\Filament\Resources\AvanceResource\Pages;

use App\Filament\Resources\AvanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAvance extends ViewRecord
{
    protected static string $resource = AvanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
