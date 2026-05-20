<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

