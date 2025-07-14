<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

final class ClientController extends Controller
{
    public function index(): Response
    {
        $clients = Client::query()->paginate(20);

        return Inertia::render('Clients/Index', ['clients' => $clients]);
    }

    public function create(): Response
    {
        return Inertia::render('Clients/Create');
    }

    public function store(StoreClientRequest $request): RedirectResponse
    {
        Client::create($request->validated());

        return redirect()->route('clients.index')->with('status', __('Client successfully created.'));
    }

    public function edit(Client $client): Response
    {
        return Inertia::render('Clients/Edit', ['client' => $client]);
    }

    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return redirect()->route('clients.index')->with('status', __('Client successfully updated.'));
    }

    public function destroy(Client $client): RedirectResponse
    {
        Gate::authorize('delete');

        $client->delete();

        return redirect()->route('clients.index')->with('status', __('Client successfully deleted.'));
    }
}
