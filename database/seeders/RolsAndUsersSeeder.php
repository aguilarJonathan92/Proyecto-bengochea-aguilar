<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolsAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear los Roles
        // Usamos insert para asegurarnos de que el ID 1 sea el SuperAdmin
        DB::table('rols')->insert([
            ['name' => 'superadmin', 'created_at' => now()],
            ['name' => 'admin', 'created_at' => now()],
            ['name' => 'cliente', 'created_at' => now()],
        ]);

        // 2. Crear el primer SuperAdmin
        // IMPORTANTE: Ajusta los datos a tu gusto
        DB::table('users')->insert([
            'firstName' => 'Super',
            'lastName' => 'Admin',
            'email' => 'admin@ejemplo.com',
            'password' => Hash::make('admin1234'), // Siempre encriptar la clave
            'rol_id' => 1, // Vinculado a superadmin
            'created_at' => now(),
        ]);
    }
}