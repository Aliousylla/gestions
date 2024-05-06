<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ClientResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClientResource\RelationManagers;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ? string $recordTitleAttribute = 'nom_client';

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->nom_client;
                
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nom_client', 'code_client', 'telephone_client','email_client'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Magasin' => $record->magasin->nom_magasin
        ];
    }

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
        return static::getModel()::count() > 10 ? 'warning' : 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nom_client')
                    ->label(__('Prenom et nom   du client'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('adresse_client')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('telephone_client')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email_client')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('plafond_client')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('magasin_id')
                    ->relationship(name:'magasin', titleAttribute:'nom_magasin')
                    ->preload()
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code_client')
                     ->sortable()
                    ->searchable()
                    ->label(__('Code')),
                Tables\Columns\TextColumn::make('nom_client')
                    ->label(__('Prenom & Nom'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('adresse_client')
                    ->label(__('Adresse'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('telephone_client')
                     ->label(__('N ° Téléphone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_client')
                    ->label(__('Email'))
                    ->toggleable(isToggledHiddenByDefault: true)                
                    ->searchable(),
                Tables\Columns\TextColumn::make('plafond_client')
                    ->label(__('Plafond'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('magasin.nom_magasin')
                    ->label(__('Magasin'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('date  d\'ajout'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Date  de modification'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            // 'view' => Pages\ViewClient::route('/{record}'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
