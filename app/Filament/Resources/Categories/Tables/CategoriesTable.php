<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // ID de la categoría (opcional, útil para control interno)
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                // Nombre de la categoría
                TextColumn::make('name')
                    ->label('Nombre de la Categoría')
                    ->searchable() // Permite buscar categorías rápidamente
                    ->sortable()
                    ->weight('bold'),
                //Nombre para mostrar en la web
                TextColumn::make('display_title')
                    ->label('Título Largo/Comercial')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),
                // Conteo de productos (Muestra cuántos productos tiene cada categoría)
                TextColumn::make('products_count')
                    ->label('Cant. Productos')
                    ->counts('products') // Usa el nombre de la relación HasMany de tu modelo
                    ->badge()
                    ->color('info')
                    ->alignCenter(),

                // Fecha de creación
                TextColumn::make('created_at')
                    ->label('Creada el')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->successNotification(null) // 1. Apagamos el cartel automático de Filament
                        ->action(function (Collection $records) {
                            $contadorEliminados = 0;
                            $seleccionoOtros = false;

                            $records->each(function (Model $record) use (&$contadorEliminados, &$seleccionoOtros) {
                                // Saltamos la categoría "Otros" (ID 1)
                                if ($record->id === 1) {
                                    $seleccionoOtros = true;
                                    return;
                                }

                                // Reasignación de productos
                                $record->products()->update(['category_id' => 1]);
                                $record->delete();

                                $contadorEliminados++; // Sumamos uno por cada éxito real
                            });

                            // 2. Evaluamos qué notificación mostrar según el resultado
                            if ($contadorEliminados > 0) {
                                // Si se borró al menos una categoría válida
                                Notification::make()
                                    ->success()
                                    ->title('Categorías eliminadas y productos reasignados con éxito')
                                    ->send();
                            } elseif ($seleccionoOtros && $records->count() === 1) {
                                // Si SOLO se había marcado la categoría "Otros"
                                Notification::make()
                                    ->warning()
                                    ->title('Acción cancelada')
                                    ->body('La categoría "Otros" está protegida por el sistema y no puede ser eliminada.')
                                    ->send();
                            }
                        }),
                ]),
            ]);
    }
}
