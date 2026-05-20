<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('last_name')
                    ->label('Apellido/s')
                    ->required()
                    ->string()
                    ->maxLength(255),

                TextInput::make('first_name')
                    ->label('Nombre/s')
                    ->required()
                    ->string()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Correo Electrónico')
                    ->email()
                    ->required()
                    ->string()
                    ->maxLength(255)
                    // Aplica el 'unique:users,email' pero ignora al usuario actual si se está editando
                    ->unique(table: 'users', column: 'email', ignoreRecord: true),

                DateTimePicker::make('email_verified_at')
                ->label('Correo verificado el día'),

                Select::make('role_id')
                    ->label('Rol')
                    ->relationship('role', 'name')
                    ->required()
                    ->preload(),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    // Obligatorio al crear, opcional al editar (para no forzar a cambiarla siempre)
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->string()
                    ->minLength(8) // Bloquea contraseñas cortas
                    ->confirmed()  // Busca el campo 'password_confirmation'
                    // Encripta automáticamente antes de guardar en la base de datos
                    //->dehydrateStateUsing(fn ($state) => Hash::make($state)) ya lo maneja el Modelo con el casteo
                    // Si el admin no escribe nada al editar, mantiene la contraseña que ya tenía
                    ->dehydrated(fn ($state) => filled($state)),

                // Campo espejo obligatorio para que la regla 'confirmed' funcione
                TextInput::make('password_confirmation')
                    ->label('Confirmar Contraseña')
                    ->password()
                    // Obligatorio solo si es un nuevo registro o si el admin quiere cambiar la contraseña al editar
                    ->required(fn (string $operation, $get): bool => $operation === 'create' || filled($get('password')))
                    ->dehydrated(false), // Indica a Filament que no intente guardar esto en la BD
            ]);
    }
}
