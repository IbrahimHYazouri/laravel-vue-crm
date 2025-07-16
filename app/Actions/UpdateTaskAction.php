<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Project;
use App\Models\Task;

final class UpdateTaskAction
{
    public function execute(Task $task, array $data): void
    {
        $project = Project::findOrFail($data['project_id']);

        $task->update([
            ...$data,
            'client_id' => $project->client_id,
        ]);
    }
}
