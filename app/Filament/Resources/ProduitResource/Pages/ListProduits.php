<?php

namespace App\Filament\Resources\ProduitResource\Pages;

use Filament\Actions;
use App\Models\Produit;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ProduitResource;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListProduits extends ListRecords
{
    protected static string $resource = ProduitResource::class;

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
                ->badge(Produit::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce mois-ci' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(Produit::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette année' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(Produit::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
