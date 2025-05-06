<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear el permiso 'Administrador configuracion' si no existe
        $permission = Permission::firstOrCreate(['name' => 'Administrador configuracion']);

        // Obtener el rol 'Admin' o crearlo si no existe
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Asignar el permiso al rol 'Admin'
        $adminRole->givePermissionTo($permission);
    }
}