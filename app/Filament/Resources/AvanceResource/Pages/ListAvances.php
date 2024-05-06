<?php

namespace App\Filament\Resources\AvanceResource\Pages;

use App\Filament\Resources\AvanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAvances extends ListRecords
{
    protected static string $resource = AvanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
