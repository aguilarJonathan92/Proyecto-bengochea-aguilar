<?php

namespace App\Filament\Resources\Queries\Tables;

use Filament\Actions\BulkActionGroup as ActionsBulkActionGroup;
use Filament\Actions\DeleteBulkAction as ActionsDeleteBulkAction;
use Filament\Actions\ViewAction as ActionsViewAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;


class QueriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre/Apodo')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),

                // Mapeo directo al campo 'subject' en inglés mediante conversión nativa
                TextColumn::make('subject')
                    ->label('Asunto / Motivo')
                    ->formatStateUsing(fn(int $state): string => match ($state) {
                        1 => 'Formas de pago',
                        2 => 'Modos/costos de envío',
                        3 => 'Devolución',
                        4 => 'Cuenta',
                        5 => 'Otros',
                        default => 'No especificado',
                    }),

                TextColumn::make('created_at')
                    ->label('Fecha de Recepción')
                    ->dateTime('d/m/Y H:i', 'America/Argentina/Buenos_Aires')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Mantenido tal cual lo definiste originalmente
                TextColumn::make('updated_at')
                    ->label('Fecha de Actualización')
                    ->dateTime('d/m/Y H:i', 'America/Argentina/Buenos_Aires')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Etiqueta visual de estado con colores dinámicos
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'danger',
                        'processing' => 'warning',
                        'resolved' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Pendiente',
                        'processing' => 'En revisión',
                        'resolved' => 'Resuelta',
                        default => $state,
                    }),
            ])
            ->filters([
                // Filtro para buscar rápidamente por un estado específico
                SelectFilter::make('status')
                    ->label('Filtrar por Estado')
                    ->options([
                        'pending' => 'Pendiente',
                        'processing' => 'En revisión',
                        'resolved' => 'Resuelta',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')

            ->recordActions([
                ActionsViewAction::make(),
            ])

            // Corregido el método y namespaces nativos para acciones por lotes en tablas
            ->toolbarActions([
                ActionsBulkActionGroup::make([
                    ActionsDeleteBulkAction::make(),
                ]),
            ]);
    }
}
