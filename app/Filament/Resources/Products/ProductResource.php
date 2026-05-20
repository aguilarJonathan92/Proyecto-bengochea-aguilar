<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
            'view' => Pages\ViewProduct::route('/{record}'),
        ];
    }

    //Función para ignorar el active = false,asi aquí si se pueden visualizar productos desactivados
    public static function getEloquentQuery(): Builder
    {
        // Esto desactiva el alcance global "active" solo en Filament
        return parent::getEloquentQuery()->withoutGlobalScope('active');
    }

    // Define qué campos se usan para la búsqueda global en la barra superior
    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'subtitle', 'description'];
    }
    // Personaliza lo que se ve en el resultado de búsqueda global
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Categoría' => $record->category->name,
            'Precio' => '$' . number_format($record->price, 2),
        ];
    }

    // Nombre en la barra lateral
    protected static ?string $navigationLabel = 'Productos';

    // Título de la página (en plural)
    protected static ?string $pluralLabel = 'Productos';

    // Título para un solo registro (ej: "Crear Producto")
    protected static ?string $modelLabel = 'Producto';
}
