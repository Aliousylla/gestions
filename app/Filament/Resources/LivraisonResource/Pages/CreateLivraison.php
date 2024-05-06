<?php

namespace App\Filament\Resources\LivraisonResource\Pages;

use Filament\Actions;
use App\Models\Livraison;
use App\Models\Mouvement;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\LivraisonResource;

class CreateLivraison extends CreateRecord
{
    protected static string $resource = LivraisonResource::class;

    protected function handleRecordCreation(array $data): Model
{
    // Validate Livraison data
    // $validatedData = $this->validateRecord($data);

    // Create Livraison instance
    $livraison = static::getModel()::create($data);

    // Handle Mouvements creation using a transaction
    DB::transaction(function () use ($livraison, $data) {
        // Retrieve Mouvements data
        $mouvements = $data['mouvements'] ?? [];

        // Create Mouvement records for each item
        foreach ($mouvements as $mouvementData) {
            $mouvementData['livraison_id'] = $livraison->id; // Associate Mouvement with Livraison
            $mouvement = new Mouvement;
            $mouvement->fill($mouvementData); // Fill Mouvement with validated data
            $mouvement->save(); // Save Mouvement record
        }
    });

    return $livraison;
}
protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

    
}
