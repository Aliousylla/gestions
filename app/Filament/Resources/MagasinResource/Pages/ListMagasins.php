<?php

namespace App\Filament\Resources\MagasinResource\Pages;

use App\Filament\Resources\MagasinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMagasins extends ListRecords
{
    protected static string $resource = MagasinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
