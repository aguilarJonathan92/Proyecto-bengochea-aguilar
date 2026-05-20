<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBrand extends EditRecord
{
    protected static string $resource = BrandResource::class;

    // En EditBrand.php
    protected function getHeaderActions(): array
    {
        return [
            Action::make('verWeb')
                ->label('Ver en tienda')
                ->color('gray')
                ->icon('heroicon-o-eye')
                ->url(function (): ?string {
                    // Validación de seguridad por si acaso la marca no tiene nombre aún
                    if (empty($this->record->name) || strlen($this->record->name) < 3) {
                        return null;
                    }

                    return route('search', [
                        'query' => $this->record->name, // Le envía el nombre de la marca al parámetro ?query=
                    ]);
                })
                // Si el nombre tiene menos de 3 caracteres, deshabilitamos el botón para evitar el error del controlador
                ->disabled(fn() => empty($this->record->name) || strlen($this->record->name) < 3)
                ->openUrlInNewTab(),

            DeleteAction::make(),
        ];
    }
}
