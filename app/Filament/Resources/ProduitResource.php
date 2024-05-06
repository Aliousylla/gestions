<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategorieRessourceResource\RelationManagers\ProduitsRelationManager;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Produit;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProduitResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Factories\Relationship;
use App\Filament\Resources\ProduitResource\RelationManagers;

class ProduitResource extends Resource
{
    protected static ?string $model = Produit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['magasin']);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'warning';
    }

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code_produit')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('libelle')
                    ->label(__('Nom produit'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('prix_achat')
                    ->label(__("Prix d'achat"))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('prix_vente')
                    ->label(__('Prix de vente'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre_carton')
                     ->label(__('Nombre de carton'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre_piece_carton')
                    ->label(__('Nombre piece par carton'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categorie.nom_categorie')
                    ->label(__('Categorie'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('magasin.nom_magasin')
                    ->label(__('Magasin'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ImageColumn::make('chemin')
                    ->label(__('Image du produit'))
                    ->toggleable(isToggledHiddenByDefault: true), 
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
                SelectFilter::make('Categorie')
                    ->relationship('categorie', 'nom_categorie')
                    ->searchable()
                    ->preload()
                    ->label('Filter par Categorie')
                    ->indicator('Categorie'),
                    SelectFilter::make('Magasin')
                    ->relationship('magasin', 'nom_magasin')
                    ->searchable()
                    ->preload()
                    ->label('Filter par magasin')
                    ->indicator('magasin'),
                    Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'créé à partir de ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = ' créé avant le ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
                    
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
            'index' => Pages\ListProduits::route('/'),
            'create' => Pages\CreateProduit::route('/create'),
            // 'view' => Pages\ViewProduit::route('/{record}'),
            'edit' => Pages\EditProduit::route('/{record}/edit'),
        ];
    }
}
