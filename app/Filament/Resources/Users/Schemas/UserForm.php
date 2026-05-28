<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use SebastianBergmann\Type\TrueType;

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
                    //La edición del campo se desactiva si es una cuenta existente y el id es distinto al autenticado
                    //Permite que el admin cree perfiles o modifique campos pero solo del suyo.
                    ->disabled(fn($record) => $record !== null && Filament::auth()->id() !== $record->id)
                    //Si es una cuenta nueva o es el admin(coincide el id) el campo se envia a la bd.
                    //Además con required filament evalua que no se envíe vacío de manera doble.
                    ->dehydrated(fn($record) => $record === null || Filament::auth()->id() === $record->id)
                    ->maxLength(255),

                TextInput::make('first_name')
                    ->label('Nombre/s')
                    ->required()
                    ->string()
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
                    // Aplica el 'unique:users,email' pero ignora al usuario actual si se está editando
                    ->unique(table: 'users', column: 'email', ignoreRecord: true),

                DateTimePicker::make('email_verified_at')
                    ->label('Correo verificado el día')
                    ->timezone('America/Argentina/Buenos_Aires'), // Mantenemos la consistencia horaria local

                Select::make('role_id')
                    ->label('Rol')
                    ->relationship('role', 'name')
                    ->required()
                    ->preload()
                    // 🔒 Seguridad Absoluta nativa de Filament:
                    // Si el ID del usuario autenticado en el panel coincide con el ID del registro en pantalla,
                    // el selector se congela por completo, impidiendo que el admin se degrade a cliente.
                    ->disabled(fn($record): bool => $record !== null && Filament::auth()->id() === $record->id)

                    // Evita enviar el campo si está deshabilitado para que no altere el rol en la base de datos
                    ->dehydrated(fn($state) => filled($state)),

                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    // Obligatorio al crear, opcional al editar (para no forzar a cambiarla siempre)
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->string()
                    ->minLength(8) // Bloquea contraseñas cortas
                    ->confirmed()  // Busca el campo 'password_confirmation'
                    // Encripta automáticamente antes de guardar en la base de datos
                    //->dehydrateStateUsing(fn ($state) => Hash::make($state)) ya lo maneja el Modelo con el casteo
                    // Si el admin no escribe nada al editar, mantiene la contraseña que ya tenía
                    ->dehydrated(fn($state) => filled($state)),

                // Campo espejo obligatorio para que la regla 'confirmed' funcione
                TextInput::make('password_confirmation')
                    ->label('Confirmar Contraseña')
                    ->password()
                    // Obligatorio solo si es un nuevo registro o si el admin quiere cambiar la contraseña al editar
                    ->required(fn(string $operation, $get): bool => $operation === 'create' || filled($get('password')))
                    ->dehydrated(false), // Indica a Filament que no intente guardar esto en la BD
            ]);
    }
}
