<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

final class ProjectsPageTest extends TestCase
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

    public function test_user_with_admin_role_can_view_projects_index_page()
    {
        /** @var User $user */
        $admin = User::factory()->create();

        $admin->assignRole('admin');

        $this->actingAs($admin)
            ->get('/projects')
            ->assertOk();
    }

    public function test_user_with_user_role_can_view_projects_index_page()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/projects')
            ->assertOk();
    }

    public function test_user_with_admin_role_can_delete_projects()
    {
        /** @var User $user */
        $admin = User::factory()->create();

        $admin->assignRole('admin');

        /** @var Project $projectToDelete */
        $projectToDelete = Project::factory()->create();

        $this->actingAs($admin)
            ->delete('/projects/'.$projectToDelete->id)
            ->assertRedirect();

        $this->assertSoftDeleted('projects', [
            'id' => $projectToDelete->id,
        ]);
    }

    public function test_user_with_user_role_cannot_delete_projects()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Project $projectToDelete */
        $projectToDelete = Project::factory()->create();

        $this->actingAs($user)
            ->delete('/projects/'.$projectToDelete->id)
            ->assertForbidden();

        $this->assertDatabaseHas('projects', [
            'id' => $projectToDelete->id,
        ]);
    }
}
