<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateCategoryDisplayTitlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nombresCategorias = [
            1 => 'Instrumentos Musicales',
            2 => 'Equipos de Audio y Sonido',
            3 => 'Trípodes y Soportes',
            4 => 'Accesorios',
            5 => 'Iluminación y Estudio',
           //Crear manualmente para probar
           // 6 => 'Bolsos y Mochilas',
           // 7 => 'Outlet 🔥'
        ];

        foreach ($nombresCategorias as $id => $displayTitle) {
            // Buscamos la categoría por ID y le actualizamos el campo
            Category::query()->where('id', $id)->update([
                'display_title' => $displayTitle
            ]);
        }
    }
}
