<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MouvementResource\Pages;
use App\Filament\Resources\MouvementResource\RelationManagers;
use App\Models\Mouvement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MouvementResource extends Resource
{
    protected static ?string $model = Mouvement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('prix_vente')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('quantite_piece_vendue')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\TextInput::make('produit_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('magasin_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('commande_id')
                    ->numeric(),
                Forms\Components\TextInput::make('livraison_id')
                    ->numeric(),
                Forms\Components\TextInput::make('retour_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('prix_vente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantite_piece_vendue')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('produit_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('magasin_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('commande_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('livraison_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('retour_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMouvements::route('/'),
            'create' => Pages\CreateMouvement::route('/create'),
            'view' => Pages\ViewMouvement::route('/{record}'),
            'edit' => Pages\EditMouvement::route('/{record}/edit'),
        ];
    }
}
