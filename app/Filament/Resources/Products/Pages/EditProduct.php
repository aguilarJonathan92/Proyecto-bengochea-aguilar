<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function beforeSave(): void
    {
        $record = $this->getRecord();

        // 1. Metemos en un array todas las imágenes que son opcionales
        $imagenesOpcionales = ['image_2', 'image_3'];

        foreach ($imagenesOpcionales as $campo) {
            // 2. Si el producto tenía archivo pero en el formulario se quitó...
            if ($record->$campo && empty($this->data[$campo])) {
                if (Storage::disk('public')->exists($record->$campo)) {
                    Storage::disk('public')->delete($record->$campo);
                }
            }
        }
    }


    protected function getHeaderActions(): array
    {
        return [
            // Acción para ver el producto en la parte pública
            Action::make('ver_tienda')
                ->label('Ver en Tienda')
                ->color('gray')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->url(fn(): string => route('product-details', ['id' => $this->record->id]))
                ->openUrlInNewTab(),

            DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
