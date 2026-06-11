<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBrand extends EditRecord
{
    protected static string $resource = BrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('verWeb')
                ->label('Ver en tienda')
                ->color('primary')
                ->icon('heroicon-o-eye')
                ->url(function (): ?string {
                    if (empty($this->record->name) || strlen($this->record->name) < 3) {
                        return null;
                    }
                    return route('search', ['query' => $this->record->name]);
                })
                ->disabled(fn() => empty($this->record->name) || strlen($this->record->name) < 3)
                ->openUrlInNewTab(),

            // Al ser soft delete, Filament sabe de forma nativa qué hacer
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
