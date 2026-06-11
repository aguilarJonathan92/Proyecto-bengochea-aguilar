<?php

namespace App\Filament\Resources\Brands\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class BrandsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Marca')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                // Contador de productos por marca
                TextColumn::make('products_count') //nombre del método en el modelo Brands + _count que autom. obtiene la cantidad
                    ->label('Nro Productos Disponibles')
                    ->counts('products') // Usa la relación HasMany definida en tu modelo
                    ->badge()
                    ->alignCenter()
                    ->color('success'),

                // Usamos ToggleColumn para que puedas activar/desactivar
                // la marca directamente desde la lista sin entrar a editar
                ToggleColumn::make('active')
                    ->label('¿Marca activa?'),

                TextColumn::make('updated_at')
                    ->label('Última edición')
                    ->dateTime('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtro rápido para ver solo marcas activas o inactivas
                TernaryFilter::make('active')
                    ->label('Estado de Marca')
                    ->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // ACCIÓN 1: ACTIVAR
                    BulkAction::make('activar')
                        ->label('Activar seleccionadas')
                        ->icon('heroicon-o-check-circle')
                        ->color('success') // Color verde
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            // Solo procesa las que están desactivadas actualmente
                            $records->where('active', false)->each(fn($record) => $record->update(['active' => true]));
                        })
                        ->successNotificationTitle('Marcas seleccionadas activadas'),
                    // ACCIÓN 2: DESACTIVAR
                    BulkAction::make('desactivar')
                        ->label('Desactivar seleccionadas')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            // Solo procesa las que están activas actualmente
                            $records->where('active', true)->each(fn($record) => $record->update(['active' => false]));
                        })
                        ->successNotificationTitle('Marcas seleccionadas desactivadas'),
                ]),
            ]);
    }
}
