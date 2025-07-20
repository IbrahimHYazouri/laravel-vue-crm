<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

final class ClientPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'delete']);

        Role::create(['name' => 'admin'])->givePermissionTo(['manage users', 'delete']);
        Role::create(['name' => 'user']);
    }

    public function test_user_with_admin_role_can_view_clients_index_page()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $user->assignRole('admin');

        $this->actingAs($user)
            ->get('/clients')
            ->assertOk();
    }

    public function test_user_with_user_role_can_view_clients_index_page()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/clients')
            ->assertOk();
    }

    public function test_user_with_admin_role_can_delete_clients()
    {
        /** @var User $user */
        $admin = User::factory()->create();

        $admin->assignRole('admin');

        /** @var Client $clientToDelete */
        $clientToDelete = Client::factory()->create();

        $this->actingAs($admin)
            ->delete('/clients/'.$clientToDelete->id)
            ->assertRedirect();

        $this->assertSoftDeleted('clients', [
            'id' => $clientToDelete->id,
        ]);
    }
}
