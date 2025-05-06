<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SecurityTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Verifica que los usuarios no autenticados no puedan acceder a rutas protegidas.
     */
    public function test_unauthenticated_users_cannot_access_protected_routes(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');

        $response = $this->get('/roles');
        $response->assertRedirect('/login');

        $response = $this->get('/permisos');
        $response->assertRedirect('/login');
    }

    /**
     * Verifica que los usuarios sin permisos no puedan realizar acciones restringidas.
     */
    public function test_users_without_permissions_cannot_access_restricted_routes(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/roles')
            ->assertStatus(403);

        $this->actingAs($user)
            ->post('/roles', ['nombre' => 'Admin'])
            ->assertStatus(403);
    }

    /**
     * Verifica que los usuarios con permisos puedan realizar acciones restringidas.
     */

}
