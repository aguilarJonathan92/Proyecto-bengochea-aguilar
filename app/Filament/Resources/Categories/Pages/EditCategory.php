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

            DeleteAction::make() //No permite borrar la categoría OTROS (id 1)
                ->hidden(fn($record) => $record->id === 1)
                ->before(function ($record) {
                    $record->products()->update(['category_id' => 1]);
                }), //En caso de que la categoría sea eliminable, los productos son reasignados a la categ. 'Otros' por defecto
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
