<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear el rol de administrador si no existe
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Crear un usuario con el rol de administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Cambia el correo si es necesario
            [
                'name' => 'Administrador',
                'password' => bcrypt('password'), // Cambia la contraseña si es necesario
                'email_verified_at' => now(),
            ]
        );

        // Asignar el rol de administrador al usuario
        $adminUser->assignRole($adminRole);
    }
}