<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->success()
                    ->title('Client supprimé.')
                    ->body('Le client a supprimé avec succès.')
            ),
        ];
    }
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Client mis à jour.')
            ->body('Le client a été mis à jour avec succès.');
    }
}
