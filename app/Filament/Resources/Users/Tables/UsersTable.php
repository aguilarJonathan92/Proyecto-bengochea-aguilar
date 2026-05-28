<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('last_name')
                    ->label('Apellido/s')
                    ->searchable(),

                TextColumn::make('first_name')
                    ->label('Nombre/s')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),

                TextColumn::make('email_verified_at')
                    ->label('Fecha de verif. de correo')
                    ->dateTime('d/m/Y H:i', 'America/Argentina/Buenos_Aires')
                    ->sortable(),

                TextColumn::make('role.name')
                    ->label('Rol')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime('d/m/Y H:i', 'America/Argentina/Buenos_Aires')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Última actualización')
                    ->dateTime('d/m/Y H:i', 'America/Argentina/Buenos_Aires')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])

            // 🟢 Corregido el método nativo para el manejo de acciones por lote / toolbar
            // Quitada la opción de borrar en grupo: ignora la política de usuario
            ->bulkActions([
                /* \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
                ]), */
            ]);
    }
}
