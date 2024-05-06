<?php

namespace App\Filament\Resources\RetourResource\Pages;

use App\Filament\Resources\RetourResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRetours extends ListRecords
{
    protected static string $resource = RetourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
