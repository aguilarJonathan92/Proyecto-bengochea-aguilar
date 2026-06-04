<?php

namespace App\Filament\Resources\Users\RelationManagers;

use App\Filament\Resources\Orders\OrderResource;
use App\Filament\Resources\Products\Pages\ViewUser;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $relatedResource = OrderResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                //CreateAction::make(),
            ]);
    }
    public static function canViewForRecord($record, $pageClass): bool
{
    // Solo se muestra si la página actual es la de "ViewUser"
    return $pageClass === ViewUser::class;
}
}
