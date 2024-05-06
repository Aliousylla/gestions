<?php

namespace App\Filament\Resources\CategorieResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProduitsRelationManager extends RelationManager
{
    protected static string $relationship = 'produits';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('libelle')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('reference')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('prix_achat')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('prix_vente')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('nombre_carton')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('nombre_piece_carton')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('categorie_id')
                    ->required()
                    ->preload()
                    ->searchable()
                    ->relationship(name:'categorie',titleAttribute:'nom_categorie'),
                Forms\Components\Select::make('magasin_id')
                    ->relationship(name:'magasin', titleAttribute:'nom_magasin')
                    ->preload()
                    ->searchable()
                    ->required(),
                    Forms\Components\FileUpload::make('chemin')
                    ->required()
                    ->directory('images'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('libelle')
            ->columns([
                Tables\Columns\TextColumn::make('libelle'),
                Tables\Columns\TextColumn::make('prix_achat'),
                Tables\Columns\TextColumn::make('prix_vente'),
                Tables\Columns\TextColumn::make('nombre_carton'),
                Tables\Columns\TextColumn::make('nombre_piece_carton'),
                Tables\Columns\ImageColumn::make('chemin')
                ->label(__('Image du produit'))
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
