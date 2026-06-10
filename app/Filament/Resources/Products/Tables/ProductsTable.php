<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Support\Facades\Storage;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_1')
                    ->label('Imagen')
                    ->disk('public')
                    ->circular()
                    //Abrir imagen en tamaño normal en una pestaña nueva
                    ->url(fn($record) => $record->image_1 ? Storage::url($record->image_1) : null, shouldOpenInNewTab: true),

                // Información principal
                TextColumn::make('title')
                    ->label('Titulo')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category.name') // Category tiene 'name'
                    ->label('Categoría')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('brand.name') // Atributo 'name' de Brand
                    ->label('Marca')
                    ->searchable()
                    ->sortable(),

                // Precios y Stock
                TextColumn::make('price')
                    ->label('Precio')
                    ->money('ARS') // Moneda Local
                    ->sortable(),

                TextColumn::make('stock')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('views')
                    ->label('Nro de vistas')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),

                // Estados (on_sale y active)
                // CheckboxColumn permite editar el estado directamente desde la tabla
                CheckboxColumn::make('active')
                    ->label('Activo'),

                IconColumn::make('on_sale')
                    ->label('Oferta')
                    ->boolean()
                    ->trueIcon('heroicon-o-tag')
                    ->falseIcon('heroicon-o-x-circle')
                    ->color(fn(bool $state): string => $state ? 'success' : 'gray'),

                TextColumn::make('discount')
                    ->label('% Desc.')
                    ->suffix('%')
                    ->visible(fn($record) => $record?->on_sale),

                TextColumn::make('created_at')
                    ->label('Fecha en que fue agregado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // FILTRO DE RELACIÓN: Categoría
                SelectFilter::make('category_id')
                    ->label('ID De Categoría')
                    ->relationship('category', 'name') // 'category' es el método en modelo Product
                    ->label('Filtrar por Categoría')
                    ->preload()
                    ->searchable(),

                // FILTRO DE RELACIÓN: Marca
                SelectFilter::make('brand_id')
                    ->relationship('brand', 'name')
                    ->label('Filtrar por Marca')
                    ->preload(),

                // FILTRO BOOLEANO: Oferta (on_sale)
                TernaryFilter::make('on_sale')
                    ->label('¿En Liquidación?')
                    ->placeholder('Todos los productos')
                    ->trueLabel('Solo en Oferta')
                    ->falseLabel('Precio Normal'),

                // FILTRO BOOLEANO: Activo (active)
                TernaryFilter::make('active')
                    ->label('Disponibilidad')
                    ->boolean(),

                //FILTRO ELIMINADOS
                TrashedFilter::make(),
            ])

            ->recordActions([
                // Esta acción se mostrará/ejecutará SOLO si el producto NO está eliminado
                EditAction::make()
                    ->visible(fn($record) => ! $record->trashed()),
                DeleteAction::make()
                    ->visible(fn($record) => !$record->trashed()),

                // Esta acción se mostrará/ejecutará SOLO si el producto SÍ está eliminado
                RestoreAction::make()
                    ->visible(fn($record) => $record->trashed()),
                //FORCEDELETE POR SI SE DESEA USAR...
                /*ForceDeleteAction::make()
                    ->visible(fn($record) => $record->trashed())
                    ->label('Borrado definitivo')
                    ->modalHeading('¿Estás absolutamente seguro?')
                    ->modalDescription('No se puede deshacer. El registro se perderá para siempre.'), */
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
