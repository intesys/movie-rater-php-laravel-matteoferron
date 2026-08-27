<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class EditMovie extends EditRecord
{
    protected static string $resource = MovieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()->label('Visualizza'),
            Actions\DeleteAction::make()->label('Elimina'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

   #[Override]
   public function getTitle(): string|Htmlable
   {
    return "Modifica il film";
   }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Film creato con successo';
    }
}
