<?php

namespace App\Filament\Resources\MouvementResource\Pages;

use App\Filament\Resources\MouvementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMouvements extends ListRecords
{
    protected static string $resource = MouvementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
