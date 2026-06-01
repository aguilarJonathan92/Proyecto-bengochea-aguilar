<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

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
                        ->action(function (Collection $records) {
                            // $records contiene todas las filas seleccionadas por el usuario
                            $records->each(function (Model $record) {
                                // Saltamos la categoría "Otros" (ID 1) para que nunca se elimine
                                if ($record->id === 1) {
                                    return;
                                }

                                // Reasignación de los productos de esta categoría a la de "Otros"
                                $record->products()->update(['category_id' => 1]);

                                // Ahora que sus productos están a salvo, eliminamos la categoría
                                $record->delete();
                            });
                        })
                        // Mensaje de éxito final
                        ->successNotificationTitle('Categorías eliminadas y productos reasignados con éxito'),
                ]),
            ]);
    }
}
