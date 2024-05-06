<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandeResource\Pages;
use App\Filament\Resources\CommandeResource\RelationManagers;
use App\Models\Commande;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommandeResource extends Resource
{
    protected static ?string $model = Commande::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero_commande')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('client_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('magasin_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('libelle')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('etat')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_commande')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_commande')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('magasin_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('libelle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('etat'),
                Tables\Columns\TextColumn::make('date_commande')
                    ->dateTime()
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
            'index' => Pages\ListCommandes::route('/'),
            'create' => Pages\CreateCommande::route('/create'),
            'view' => Pages\ViewCommande::route('/{record}'),
            'edit' => Pages\EditCommande::route('/{record}/edit'),
        ];
    }
}
