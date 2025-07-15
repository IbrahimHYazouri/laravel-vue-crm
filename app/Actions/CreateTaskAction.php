<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Project;
use App\Models\Task;

final class CreateTaskAction
{
    public function execute(array $data)
    {
        $project = Project::findOrFail($data['project_id']);

        $data['client_id'] = $project->client_id;

        return Task::create($data);
    }
}
