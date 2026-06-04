<?php

namespace App\Filament\Resources\Orders\Schemas;

// IMPORTACIONES CORRECTAS PARA FORMULARIOS EN FILAMENT v5
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use App\Models\Order;
use Filament\Schemas\Components\Section as ComponentsSection;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Datos del Cliente
                ComponentsSection::make('Información del Cliente')
                    ->description('Datos proporcionados por el comprador al momento del checkout.')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('Nombre')
                            ->disabled(),
                        TextInput::make('customer_lastname')
                            ->label('Apellido')
                            ->disabled(),
                        TextInput::make('customer_email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->disabled(),
                    ])
                    ->collapsible(),

                // Dirección de Envío
                ComponentsSection::make('Dirección de Entrega')
                    ->description('Destino donde se debe despachar el paquete.')
                    ->icon('heroicon-o-truck')
                    ->schema([
                        TextInput::make('delivery_street')
                            ->label('Calle y Número')
                            ->disabled(),
                        TextInput::make('delivery_postal_code')
                            ->label('Código Postal')
                            ->disabled(),
                        Select::make('delivery_city_id')
                            ->label('Ciudad / Localidad')
                            ->relationship('city', 'name')
                            ->disabled(),
                    ])
                    ->collapsible(),

                // ÍTEMS COMPRADOS
                ComponentsSection::make('Productos en el Pedido')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        Repeater::make('items')
                            ->relationship('items')
                            ->label(false)
                            ->schema([
                                Select::make('product_id')
                                    ->label('Producto')
                                    ->relationship('product', 'title')
                                    ->disabled(),
                                TextInput::make('quantity')
                                    ->label('Cantidad')
                                    ->numeric()
                                    ->disabled(),
                                TextInput::make('price')
                                    ->label('Precio Unitario')
                                    ->numeric()
                                    ->prefix('$')
                                    ->disabled(),
                            ])
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false),
                    ]),

                // Estado y Pago
                ComponentsSection::make('Estado y Pago')
                    ->schema([
                        Select::make('status')
                            ->label('Estado de la Orden')
                            ->required()
                            ->options([
                                'pending' => 'Pendiente de Pago',
                                'processing' => 'En Proceso / Armando Pedido',
                                'shipped' => 'Despachado / Enviado',
                                'delivered' => 'Entregado',
                                'cancelled' => 'Cancelado',
                            ])
                            ->selectablePlaceholder(false),

                        TextInput::make('payment_method')
                            ->label('Método de Pago')
                            ->disabled(),

                        TextInput::make('total')
                            ->label('Total Cobrado')
                            ->prefix('$')
                            ->formatStateUsing(fn($state) => number_format((float)$state, 2, ',', '.'))
                            ->readOnly()
                            ->dehydrated(false)
                            ->extraInputAttributes(['class' => 'font-bold text-lg text-primary-600']),
                    ]),

                // Metadatos
                ComponentsSection::make('Metadatos')
                    ->schema([
                        TextInput::make('created_at')
                            ->label('Fecha de Compra')
                            ->readOnly()
                            ->dehydrated(false)
                            ->afterStateHydrated(function (TextInput $component, $state) {
                                if ($state) {
                                    $component->state(\Carbon\Carbon::parse($state)
                                        ->setTimezone('America/Argentina/Buenos_Aires')
                                        ->format('d/m/Y H:i'));
                                }
                            }),

                        TextInput::make('user_fullname')
                            ->label('Usuario Registrado')
                            ->disabled()
                            ->formatStateUsing(function (Order $record) {
                                return $record->user ? $record->user->name : 'Usuario no encontrado';
                            }),
                    ])
                    ->icon('heroicon-o-information-circle')
                    ->collapsible(),
            ]);
    }
}
