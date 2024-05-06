<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RetourResource\Pages;
use App\Filament\Resources\RetourResource\RelationManagers;
use App\Models\Retour;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RetourResource extends Resource
{
    protected static ?string $model = Retour::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero_retour')
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
                Forms\Components\TextInput::make('livraison_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('date_retour')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_retour')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('magasin_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('libelle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('livraison_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_retour')
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
            'index' => Pages\ListRetours::route('/'),
            'create' => Pages\CreateRetour::route('/create'),
            'view' => Pages\ViewRetour::route('/{record}'),
            'edit' => Pages\EditRetour::route('/{record}/edit'),
        ];
    }
}
