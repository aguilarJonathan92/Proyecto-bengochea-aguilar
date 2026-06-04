<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
// Si quisiera cambiar el estado desde la tabla
// use Filament\Tables\Columns\SelectColumn;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // 1. El ID de la Orden como identificador principal
                TextColumn::make('id')
                    ->label('Orden #')
                    ->searchable()
                    ->sortable(),

                // 2. Traemos el nombre del usuario usando la relación 'user'
                TextColumn::make('user.name')
                    ->label('Usuario Reg.')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Oculto por defecto si prefieren guiarse por los datos del cliente

                // 3. Concatenamos Nombre y Apellido del Cliente que compró
                TextColumn::make('customer_fullname')
                    ->label('Cliente')
                    ->searchable(['customer_name', 'customer_lastname']) // Permite buscar por ambos campos
                    ->state(function (Order $record): string {
                        return "{$record->customer_name} {$record->customer_lastname}";
                    }),

                // 4. Mostramos la Ciudad usando la relación 'city'
                TextColumn::make('city.name')
                    ->label('Ciudad')
                    ->searchable()
                    ->sortable(),

                // 5. Formato moneda para el total (ej: ARS o el símbolo $)
                TextColumn::make('total')
                    ->label('Total')
                    ->money('ARS') // Podés cambiarlo por 'USD' o la moneda de tu tienda
                    ->sortable(),

                // 6. Método de Pago resumido
                TextColumn::make('payment_method')
                    ->label('Pago')
                    ->searchable(),

                // 7. El Estado Del Envío.
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->formatStateUsing(fn($record) => $record->status_label) // <-- Usa tu Opción 1
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'shipped' => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                // 8. Traemos al frente la fecha de creación para saber cuándo se compró
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i', 'America/Argentina/Buenos_Aires')
                    ->sortable(),
            ])
            // Ordenar por defecto de la orden más nueva a la más vieja
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                ->label('Ver Detalles'),
                EditAction::make()
                ->label('Cambiar Estado'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
