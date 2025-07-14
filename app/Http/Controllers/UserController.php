<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::query()
            ->with('roles')
            ->paginate(20);

        return Inertia::render('Users/Index', ['users' => $users]);
    }

    public function create(): Response
    {
        $roles = Role::all();

        return Inertia::render('Users/Create', ['roles' => $roles]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        if ($request->has('terms_accepted')) {
            $user->terms_accepted_at = now();
            $user->save();
        }

        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('users.index')->with('status', __('User successfully created.'));
    }

    public function edit(User $user): Response
    {
        $roles = Role::all();
        $user->load('roles');

        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        if ($request->has('terms_accepted') && ! $user->terms_accepted_at) {
            $user->terms_accepted_at = now();
            $user->save();
        }

        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        return redirect()->route('users.index')->with('status', __('User successfully updated.'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')->with('status', __('User successfully deleted.'));
    }
}
