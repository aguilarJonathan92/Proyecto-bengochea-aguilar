<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Acción para ver el producto en la parte pública
            Action::make('ver_tienda')
                ->label('Ver en Tienda')
                ->color('gray')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->url(fn (): string => route('product-details', ['id' => $this->record->id]))
                ->openUrlInNewTab(),

            DeleteAction::make(),
        ];
    }
}
