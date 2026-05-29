<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use App\Http\Requests\UserRequest; // Importado UserRequest
use Filament\Facades\Filament;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        // Instancia del Request para extraer el array de reglas base.

        $requestRules = (new UserRequest())->rules();

        return $schema
            ->components([
                TextInput::make('last_name')
                    ->label('Apellido/s')
                    ->required()
                    ->string()
                    ->rules($requestRules['last_name']) // Regla del Request
                    ->disabled(fn($record) => $record !== null && Filament::auth()->id() !== $record->id)
                    ->dehydrated(fn($record) => $record === null || Filament::auth()->id() === $record->id)
                    ->maxLength(255),

                TextInput::make('first_name')
                    ->label('Nombre/s')
                    ->required()
                    ->string()
                    ->rules($requestRules['first_name']) // Regla del Request
                    ->disabled(fn($record) => $record !== null && Filament::auth()->id() !== $record->id)
                    ->dehydrated(fn($record) => $record === null || Filament::auth()->id() === $record->id)
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Correo Electrónico')
                    ->email()
                    ->required()
                    ->string()
                    ->maxLength(255)
                    ->disabled(fn($record) => $record !== null && Filament::auth()->id() !== $record->id)
                    ->dehydrated(fn($record) => $record === null || Filament::auth()->id() === $record->id)
                    // Lógica de Filament para ignorar el registro actual
                    ->unique(table: 'users', column: 'email', ignoreRecord: true),

                DateTimePicker::make('email_verified_at')
                    ->label('Correo verificado el día')
                    ->timezone('America/Argentina/Buenos_Aires'),

                Select::make('role_id')
                    ->label('Rol')
                    ->relationship('role', 'name')
                    ->required()
                    ->preload()
                    ->rules($requestRules['role_id']) // Regla del Request. Asegura que se valide contra 'exists:roles,id'
                    ->disabled(fn($record): bool => $record !== null && Filament::auth()->id() === $record->id)
                    ->dehydrated(fn($state) => filled($state)),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->string()
                    ->minLength(8)
                    ->confirmed()
                    ->rules($requestRules['password']) // Regla del Request
                    ->dehydrated(fn($state) => filled($state)),

                // Campo espejo obligatorio para la regla 'confirmed'
                TextInput::make('password_confirmation')
                    ->label('Confirmar Contraseña')
                    ->password()
                    ->required(fn(string $operation, $get): bool => $operation === 'create' || filled($get('password')))
                    ->dehydrated(false),
            ]);
    }
}
