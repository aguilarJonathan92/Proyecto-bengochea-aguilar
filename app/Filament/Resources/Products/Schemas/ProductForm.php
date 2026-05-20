<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Brand;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductForm
{
    public static function updatePrices(Get $get, Set $set): void
    {
        $basePrice = (float) $get('price');
        $onSale = (bool) $get('on_sale');
        $discount = (float) $get('discount'); // Verifica que el nombre sea 'discount'
        $installments = (int) $get('installments') ?: 1;

        $finalPrice = $basePrice;

        if ($onSale && $discount > 0) {
            $finalPrice = $basePrice * (1 - ($discount / 100));
        }

        // Actualizamos el campo visual del precio de oferta
        $set('sale_price', round($finalPrice, 2));

        // Actualizamos el valor de la cuota
        $installmentValue = $finalPrice / $installments;
        $set('installment_price', round($installmentValue, 2));
    }
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Información del Instrumento')
                    ->description('Detalles principales del producto')
                    ->schema([
                        Select::make('brand_id')
                            ->label('Marca')
                            ->relationship(
                                'brand',
                                'name',
                                modifyQueryUsing: function (Builder $query, ?Model $record) {
                                    // Si el producto existe (estamos editando)
                                    if ($record && $record->brand_id) {
                                        return $query->where(function ($q) use ($record) {
                                            $q->where('active', 1)
                                                ->orWhere('id', $record->brand_id); // Mantenemos la marca actual aunque sea active = 0
                                        });
                                    }

                                    // Si estamos creando un producto nuevo, solo marcas activas
                                    return $query->where('active', 1);
                                }
                            ) // 'brand' es la relación en el modelo Product, 'name' es la columna en brands
                            ->options(
                                // Aquí filtramos manualmente para el formulario
                                Brand::query()
                                    ->where('active', 1) // nombre de la columna ('is_active', etc.)
                                    ->pluck('name', 'id') // trae solo esos datos, en lugar de todo como lo haría get()
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('title')
                            ->required()
                            ->label('Título'),
                        TextInput::make('subtitle') // <--- Debe ser 'subtitle'
                            ->label('Subtítulo')
                            ->maxLength(255),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->label('Categoría'),

                        Textarea::make('description')
                            ->rows(5),
                    ])->columns(2),
                // Aquí añades el resto de tus campos (price, stock, image_1, etc.)
                // SECCIÓN 2: PRECIOS Y ESTADO
                Section::make('Precios,Financiación Y Disponibilidad')
                    ->schema([
                        TextInput::make('stock')
                            ->label('Stock Del Producto')
                            ->numeric(),
                        TextInput::make('price')
                            ->label('Precio Base')
                            ->numeric()
                            ->prefix('$')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::updatePrices($get, $set)),

                        Toggle::make('on_sale')
                            ->label('¿En oferta?')
                            ->live()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::updatePrices($get, $set)),

                        TextInput::make('discount')
                            ->label('% Descuento')
                            ->numeric()
                            ->suffix('%')
                            ->visible(fn(Get $get) => $get('on_sale'))
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::updatePrices($get, $set)),

                        TextInput::make('sale_price')
                            ->placeholder(function (Get $get) {
                                $price = (float) $get('price');
                                $discount = (float) $get('discount');
                                if ($get('on_sale') && $discount > 0) {
                                    return '$' . number_format($price * (1 - ($discount / 100)), 2);
                                }
                                return 'N/A';
                            }),
                        TextInput::make('installments')
                            ->label('Cantidad de Cuotas')
                            ->numeric()
                            ->default(1)
                            ->live()
                            ->afterStateUpdated(fn(Get $get, Set $set) => self::updatePrices($get, $set)),

                        TextInput::make('installment_price')
                            ->label('Valor de cada Cuota')
                            ->numeric()
                            ->prefix('$')
                            ->readOnly()
                            ->extraAttributes(['class' => 'bg-gray-50']),
                    ])->columns(3),

                // SECCIÓN 3: MULTIMEDIA (Ajustado a tu carpeta /public/images)
                Section::make('Imágenes del Producto')
                    ->schema([
                        FileUpload::make('image_1')
                            ->label('Imagen Principal')
                            ->image()
                            ->disk('public_root')
                            ->directory('images')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->imageEditor(),

                        FileUpload::make('image_2')
                            ->label('Imagen Extra')
                            ->image()
                            ->disk('public_root') // Usamos el disco que creamos arriba
                            ->directory('images') // Se guardará en public/images/
                            ->visibility('public')
                            ->preserveFilenames() // Opcional: mantiene el nombre original del archivo
                            ->imageEditor(),
                        FileUpload::make('image_3')
                            ->label('Imagen Extra 2')
                            ->image()
                            ->disk('public_root') // Usamos el disco que creamos arriba
                            ->directory('images') // Se guardará en public/images/
                            ->visibility('public')
                            ->preserveFilenames() // Opcional: mantiene el nombre original del archivo
                            ->imageEditor(),
                    ])->columns(3),

                // SECCIÓN 4: ESPECIFICACIONES TÉCNICAS (JSON)
                Section::make('Especificaciones')
                    ->schema([
                        // Como en tu modelo tienes 'specs' => 'array'
                        KeyValue::make('specs')
                            ->label('Características Técnicas')
                            ->keyLabel('Propiedad (ej: Trastes)')
                            ->valueLabel('Valor (ej: 22)')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
