<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ProjectStatus;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        $projects = Project::with(['user', 'client'])
            ->filterStatus(request('status'))
            ->paginate(20);

        return Inertia::render('Projects/Index', ['projects' => $projects]);
    }

    public function create(): Response
    {
        $users = User::all()->append('full_name');
        $clients = Client::all();
        $statuses = ProjectStatus::cases();

        return Inertia::render('Projects/Create', [
            'clients' => $clients,
            'statuses' => $statuses,
            'users' => $users,
        ]);
    }
}
