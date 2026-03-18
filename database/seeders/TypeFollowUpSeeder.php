<?php

namespace Database\Seeders;

use App\Models\TypeFollowUp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeFollowUpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['nombre' => 'Llamada', 'color' => 'primary'],
            ['nombre' => 'Reunión', 'color' => 'secondary'],
            ['nombre' => 'Correo', 'color' => 'success'],
            ['nombre' => 'WhatsApp', 'color' => 'warning'],
            ['nombre' => 'Otro', 'color' => 'danger']
        ];

        foreach ($types as $type) {
            TypeFollowUp::create([
                'name' => $type['nombre'],
                'color' => $type['color']
            ]);
        }
    }
}
