<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class CreateMovie extends CreateRecord
{
    protected static string $resource = MovieResource::class;

    #[Override]
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    #[Override]
    public function getTitle(): string|Htmlable
    {
        return "Aggiungi un film";
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Film creato con successo';
    }
}
