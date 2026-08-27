<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovieResource\Pages;
use App\Filament\Resources\MovieResource\RelationManagers;
use App\Filament\Resources\MovieResource\RelationManagers\CastMembersRelationManager;
use App\Models\Movie;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;
    protected static ?string $label = "Films";
    protected static ?string $modelLabel = "Film";
    protected static ?string $pluralLabel = "Films";
    protected static ?string $navigationLabel = "Films";
    protected static ?string $inverseRelationship = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-film';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Titolo')
                    ->placeholder("Inserisci il titolo del film")
                    ->maxLength(255),
                TextInput::make('year')
                    ->label("Anno")
                    ->numeric()
                    ->placeholder("Inserisci l'anno del film")
                    ->required()
                    ->default(2020),
                TextInput::make('director')
                    ->label("Regista")
                    ->placeholder("Inserisci il/i regista/i")
                    ->maxLength(180),
                TextInput::make('genre')
                    ->label("Genere")
                    ->placeholder("Inserici il genere del film")
                    ->maxLength(150),
                Textarea::make('description')
                    ->label("Trama")
                    ->placeholder("Inserisci la trama del film")
                    ->rows(10)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titolo')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('year')
                    ->label('Anno')
                    ->sortable(),
                TextColumn::make('director')
                    ->label('Regista')
                    ->searchable(),
                TextColumn::make('genre')
                    ->label('Genere')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label("Data di creazione")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label("Data di modifica")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('title')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Visualizza')
                    ->hiddenLabel(),
                Tables\Actions\EditAction::make()
                ->label('Modifica')
                ->hiddenLabel(),
                Tables\Actions\DeleteAction::make()
                    ->label('Elimina')
                    ->hiddenLabel(),
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
            CastMembersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'view' => Pages\ViewMovie::route('/{record}'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}
