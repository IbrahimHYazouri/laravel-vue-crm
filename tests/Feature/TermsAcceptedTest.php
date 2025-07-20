<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class TermsAcceptedTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_without_accepted_terms_cannot_see_any_page()
    {
        $user = User::factory()->create([
            'terms_accepted_at' => null,
        ]);

        $this->actingAs($user)->get('/dashboard')
            ->assertStatus(302)
            ->assertLocation('/terms');

        $this->actingAs($user)->get('/tasks')
            ->assertStatus(302)
            ->assertLocation('/terms');

        $this->actingAs($user)->get('/projects')
            ->assertStatus(302)
            ->assertLocation('/terms');

        $this->actingAs($user)->get('/users')
            ->assertStatus(302);

        $this->actingAs($user)->get('/clients')
            ->assertStatus(302)
            ->assertLocation('/terms');
    }

    public function test_authenticated_users_can_visit_the_dashboard()
    {
        $this->actingAs(User::factory()->create());

        $this->get('/dashboard')->assertOk();
    }
}
