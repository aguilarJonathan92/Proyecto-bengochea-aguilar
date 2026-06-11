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

                    return route('search', [
                        'query' => $this->record->name,
                    ]);
                })
                ->disabled(fn() => empty($this->record->name) || strlen($this->record->name) < 3)
                ->openUrlInNewTab(),

            DeleteAction::make()
                ->before(function (Model $record, DeleteAction $action) {
                    // withTrashed() para buscar también en la papelera
                    // Ahora la consulta será: SELECT EXISTS(SELECT * FROM products WHERE brand_id = X); sin filtrar por deleted_at
                    if ($record->products()->withTrashed()->exists()) {

                        Notification::make()
                            ->danger()
                            ->title('No se puede eliminar la marca')
                            ->body("Esta marca tiene productos asociados (activos o en la papelera). Por favor, utiliza la opción de 'Desactivar' en su lugar.")
                            ->send();

                        // Cancelamos la ejecución del borrado físico en la base de datos
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
