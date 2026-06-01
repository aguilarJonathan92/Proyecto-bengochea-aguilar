<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->schema([

                TextInput::make('name') // Debe ser 'name' igual que en la DB
                    ->required()
                    ->maxLength(50),
                TextInput::make('display_title')
                    ->label('Título Largo / Comercial')
                    ->placeholder('Ej: Equipos de Audio y Sonido')
                    ->maxLength(255),
            ]);
    }
}
