<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_1')
                ->url(fn ($record)=>asset($record->image_1))
                ->getStateUsing(fn($record)=>asset($record->image_1))
                ->circular()
                ->label('Imagen'),

                // Información principal
                TextColumn::make('title')
                    ->label('Titulo')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category.name') // Asumiendo que Category tiene 'name'
                    ->label('Categoría')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('brand.name') // Asumiendo que Brand tiene 'name'
                    ->label('Marca')
                    ->searchable()
                    ->sortable(),

                // Precios y Stock
                TextColumn::make('price')
                    ->label('Precio')
                    ->money('ARS') // Cambia a tu moneda local
                    ->sortable(),

                TextColumn::make('stock')
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
                    ->relationship('category', 'name') // 'category' es el método en tu modelo Product
                    ->label('Filtrar por Categoría')
                    ->preload()
                    ->searchable(),

                // FILTRO DE RELACIÓN: Marca
                SelectFilter::make('brand_id')
                    ->relationship('brand', 'name') // Ajusta 'title' por 'name' según tu DB
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
