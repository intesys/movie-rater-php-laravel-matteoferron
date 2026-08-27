<?php

namespace App\Filament\Resources\MovieResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CastMembersRelationManager extends RelationManager
{
    protected static string $relationship = 'castMembers';
    protected static ?string $label = "Cast";
    protected static ?string $title = "Cast";

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('actor_name')
                    ->label('Attore')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('actor_name')
            ->defaultSort('actor_name')
            ->columns([
                TextColumn::make('actor_name')->label('Attore'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Aggiungi membro del cast'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifica'),
                Tables\Actions\DeleteAction::make()->label('Elimina'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
