<?php

namespace App\Filament\Resources\Queries\Pages;

use App\Filament\Resources\Queries\QueryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuery extends ViewRecord
{
    protected static string $resource = QueryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
