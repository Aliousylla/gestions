<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MagasinResource\Pages;
use App\Filament\Resources\MagasinResource\RelationManagers;
use App\Models\Magasin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MagasinResource extends Resource
{
    protected static ?string $model = Magasin::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom_magasin')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('adresse_magasin')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telephone_magasin')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nom_responsable_magasin')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom_magasin')
                    ->sortable()
                    ->label(__('Nom du magasin'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('adresse_magasin')
                    ->label(__('Adresse'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone_magasin')
                    ->label(__('Telephone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('nom_responsable_magasin')
                    ->label(__('Responsable du magasin'))
                    ->searchable(),
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
            'index' => Pages\ListMagasins::route('/'),
            'create' => Pages\CreateMagasin::route('/create'),
            'edit' => Pages\EditMagasin::route('/{record}/edit'),
        ];
    }
}
