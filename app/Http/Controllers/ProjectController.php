<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ProjectStatus;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use App\Services\ProjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

final class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectService $projectService,
    ) {}

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

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $this->projectService->createProject($request);

        return redirect()->route('projects.index')->with('success', __('Project created!'));
    }

    public function show(Project $project): Response
    {
        $project->load('user', 'client');
        $attachments = $this->projectService->getProjectAttachments($project);

        return Inertia::render('Projects/Show', ['project' => $project, 'attachments' => $attachments]);
    }

    public function edit(Project $project): Response
    {
        $project->load('user', 'client');
        $users = User::all()->append('full_name');
        $clients = Client::all();
        $statuses = ProjectStatus::cases();
        $attachments = $this->projectService->getProjectAttachments($project);

        return Inertia::render('Projects/Edit', [
            'project' => $project,
            'users' => $users,
            'clients' => $clients,
            'statuses' => $statuses,
            'attachments' => $attachments,
        ]);
    }

    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $this->projectService->updateProject($request, $project);

        return redirect()->route('projects.index')->with('success', __('Project updated!'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        Gate::authorize('delete');

        $this->projectService->deleteProject($project);

        return redirect()->route('projects.index')->with('success', __('Project deleted!'));
    }
}
