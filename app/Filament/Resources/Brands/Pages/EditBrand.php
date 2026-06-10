<?php

namespace App\Filament\Resources\Brands\Pages;

use App\Filament\Resources\Brands\BrandResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class EditBrand extends EditRecord
{
    protected static string $resource = BrandResource::class;

    // En EditBrand.php
    protected function getHeaderActions(): array
    {

        return [
            Action::make('verWeb')
                ->label('Ver en tienda')
                ->color('primary')
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

            DeleteAction::make()
                ->before(function (Model $record, DeleteAction $action) {
                    // Si la marca tiene aunque sea un producto...
                    if ($record->products()->exists()) { //es como si hiciera esta consulta: SELECT EXISTS(SELECT * FROM products WHERE brand_id = 4);

                        // Enviamos una notificación push de Filament detallando el porqué
                        Notification::make()
                            ->danger()
                            ->title('No se puede eliminar la marca')
                            ->body("Esta marca tiene productos asociados. Por favor, utiliza la opción de 'Desactivar' en su lugar.")
                            //->persistent()
                            ->send();

                        // Cancelamos la ejecución del borrado (detiene el SQL)
                        $action->halt();
                    }
                }),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
