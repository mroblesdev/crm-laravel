<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Permisos de clientes
            ['name' => 'Ver clientes', 'slug' => 'clientes'],
            ['name' => 'Crear clientes', 'slug' => 'clientes-crear'],
            ['name' => 'Editar clientes', 'slug' => 'clientes-editar'],
            ['name' => 'Eliminar clientes', 'slug' => 'clientes-eliminar'],
            ['name' => 'Reingresar clientes', 'slug' => 'clientes-reingresar'],

            // Permisos de contactos
            ['name' => 'Ver contactos', 'slug' => 'contactos'],
            ['name' => 'Crear contactos', 'slug' => 'contactos-crear'],
            ['name' => 'Editar contactos', 'slug' => 'contactos-editar'],
            ['name' => 'Eliminar contactos', 'slug' => 'contactos-eliminar'],

            // Permisos de seguimientos
            ['name' => 'Ver seguimientos', 'slug' => 'seguimientos'],
            ['name' => 'Crear seguimientos', 'slug' => 'seguimientos-crear'],
            ['name' => 'Editar seguimientos', 'slug' => 'seguimientos-editar'],
            ['name' => 'Eliminar seguimientos', 'slug' => 'seguimientos-eliminar'],

            // Permisos de tareas
            ['name' => 'Ver tareas', 'slug' => 'tareas'],
            ['name' => 'Crear tareas', 'slug' => 'tareas-crear'],
            ['name' => 'Editar tareas', 'slug' => 'tareas-editar'],
            ['name' => 'Eliminar tareas', 'slug' => 'tareas-eliminar'],
            ['name' => 'Ver calendario', 'slug' => 'calendario'],

            // Permisos de Configuración
            ['name' => 'Configuración', 'slug' => 'configuracion'],

            // Permisos de usuarios
            ['name' => 'Ver usuarios', 'slug' => 'usuarios'],
            ['name' => 'Crear usuarios', 'slug' => 'usuarios-crear'],
            ['name' => 'Editar usuarios', 'slug' => 'usuarios-editar'],
            ['name' => 'Eliminar usuarios', 'slug' => 'usuarios-eliminar'],
            ['name' => 'Gestionar permisos de usuario', 'slug' => 'usuarios-permisos'],

            // Permisos de permisos
            ['name' => 'Ver permisos', 'slug' => 'permisos'],
            ['name' => 'Crear permisos', 'slug' => 'permisos-crear'],
            ['name' => 'Editar permisos', 'slug' => 'permisos-editar'],
            ['name' => 'Eliminar permisos', 'slug' => 'permisos-eliminar'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['slug' => $permission['slug']], $permission);
        }
    }
}
