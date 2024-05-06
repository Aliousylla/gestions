<?php

namespace App\Filament\Resources\ClientResource\Pages;

use Filament\Actions;
use App\Models\Client;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ClientResource;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'Tout' => Tab::make(),
            'Cette semaine' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
                ->badge(Client::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce mois-ci' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(Client::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette année' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(Client::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
