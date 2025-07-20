<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

final class TasksPageTest extends TestCase
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

    public function test_user_with_admin_role_can_view_tasks_index_page()
    {
        /** @var User $user */
        $admin = User::factory()->create();

        $admin->assignRole('admin');

        $this->actingAs($admin)
            ->get('/tasks')
            ->assertOk();
    }

    public function test_user_with_user_role_can_view_tasks_index_page()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/tasks')
            ->assertOk();
    }

    public function test_user_with_admin_role_can_delete_tasks()
    {
        /** @var User $user */
        $admin = User::factory()->create();

        $admin->assignRole('admin');

        /** @var Task $taskToDelete */
        $taskToDelete = Task::factory()->create();

        $this->actingAs($admin)
            ->delete('/tasks/'.$taskToDelete->id)
            ->assertRedirect();

        $this->assertSoftDeleted('tasks', [
            'id' => $taskToDelete->id,
        ]);
    }

    public function test_user_with_user_role_cannot_delete_tasks()
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Task $taskToDelete */
        $taskToDelete = Task::factory()->create();

        $this->actingAs($user)
            ->delete('/tasks/'.$taskToDelete->id)
            ->assertForbidden();

        $this->assertDatabaseHas('tasks', [
            'id' => $taskToDelete->id,
        ]);
    }
}
