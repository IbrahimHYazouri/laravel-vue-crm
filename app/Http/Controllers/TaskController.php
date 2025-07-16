<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTaskAction;
use App\Actions\UpdateTaskAction;
use App\Enums\TaskStatus;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

final class TaskController extends Controller
{
    public function index(): Response
    {
        $tasks = Task::with(['user', 'client', 'project'])
            ->filterStatus(request('status'))
            ->paginate(20);

        return Inertia::render('Tasks/Index', ['tasks' => $tasks]);
    }

    public function create(): Response
    {
        $users = User::all()->append('full_name');
        $projects = Project::all();
        $statuses = TaskStatus::cases();

        return Inertia::render('Tasks/Create', [
            'users' => $users,
            'projects' => $projects,
            'statuses' => $statuses,
        ]);
    }

    public function store(StoreTaskRequest $request, CreateTaskAction $createTaskAction): RedirectResponse
    {
        try {
            $createTaskAction->execute($request->validated());

            return redirect()->route('tasks.index')->with('status', __('Task created successfully.'));
        } catch (ModelNotFoundException $ex) {
            return redirect()->back()
                ->withInput()
                ->with('error', __('The selected project was not found.'));
        }
    }

    public function edit(Task $task): Response
    {
        $users = User::all()->append('full_name');
        $projects = Project::all();
        $statuses = TaskStatus::cases();

        return Inertia::render('Tasks/Edit', [
            'task' => $task,
            'users' => $users,
            'projects' => $projects,
            'statuses' => $statuses,
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task, UpdateTaskAction $updateTaskAction): RedirectResponse
    {
        try {
            $updateTaskAction->execute($task, $request->validated());

            return redirect()->route('tasks.index')->with('status', __('Task updated successfully.'));
        } catch (ModelNotFoundException $ex) {
            return redirect()->back()
                ->withInput()
                ->with('error', __('The selected project was not found.'));
        }
    }

    public function destroy(Task $task): RedirectResponse
    {
        Gate::authorize('delete');

        try {
            $task->delete();
        } catch (QueryException $ex) {
            if ($ex->getCode() === '23000') {
                return redirect()->back()->with('status', 'Task belongs to project. Cannot delete.');
            }
        }

        return redirect()->route('tasks.index')->with('status', 'Task deleted successfully.');
    }
}
