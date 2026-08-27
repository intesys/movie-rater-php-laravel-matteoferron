<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class ViewMovie extends ViewRecord
{
    protected static string $resource = MovieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Modifica'),
        ];
    }

    #[Override]
    public function getTitle(): string|Htmlable
    {
        return "Visualizza il film";
    }

    #[Override]
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('title')
                ->label('Titolo')
                ->color('primary')
                ->size(TextEntrySize::Large)
                ->weight(FontWeight::Bold)
                ->columnSpanFull(),

            TextEntry::make('year')->label('Anno'),
            TextEntry::make('director')->label('Regista'),
            TextEntry::make('genre')->label('Genere'),
            TextEntry::make('description')
                ->label('Trama')
                ->columnSpanFull()

        ]);
    }
}
