<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('verWeb')
                ->label('Ver en la tienda')
                ->color('gray')
                ->icon('heroicon-o-eye')
                ->url(fn(): string => route('catalog', [
                    'categoria' => $this->record->id // Pasa el ID de la categoría actual
                ]))
                ->openUrlInNewTab(),

            DeleteAction::make(),
        ];
    }
}
