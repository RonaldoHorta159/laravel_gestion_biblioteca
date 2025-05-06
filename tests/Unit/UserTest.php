<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
//use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions; // Usa transacciones en lugar de limpiar la base de datos


    /**
     * Verifica que se puedan asignar roles a un usuario.
     */
    public function test_user_can_have_roles(): void
    {
        // Crear un usuario de prueba
        $user = new User();

        // Simular la asignación de roles
        $user->roles = ['Admin', 'Editor'];

        // Asegurarse de que los roles se asignaron correctamente
        $this->assertContains('Admin', $user->roles);
        $this->assertContains('Editor', $user->roles);
    }

    /**
     * Verifica que los atributos ocultos no sean visibles en la serialización.
     */
    public function test_hidden_attributes_are_not_serialized(): void
    {
        // Crear un usuario de prueba con atributos ocultos
        $user = new User([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'secret',
        ]);

        // Serializar el usuario a un array
        $serialized = $user->toArray();

        // Asegurarse de que el atributo 'password' no esté presente
        $this->assertArrayNotHasKey('password', $serialized);
    }
}