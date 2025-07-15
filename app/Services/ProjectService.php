<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

final class ProjectService
{
    public function createProject(StoreProjectRequest $request): Project
    {
        return DB::transaction(function () use ($request) {
            $project = Project::create($request->validated());

            $this->attachFiles($project, $request);

            return $project;
        });
    }

    public function updateProject(UpdateProjectRequest $request, Project $project)
    {
        return DB::transaction(function () use ($request, $project) {
            $project->update($request->validated());

            $this->removeAttachment($project, $request);
            $this->attachFiles($project, $request);

            return $project->fresh();
        });
    }

    public function getProjectAttachments(Project $project): MediaCollection
    {
        return $project->getMedia('attachments');
    }

    private function removeAttachment(Project $project, UpdateProjectRequest $request): void
    {
        $removedIds = $request->input('removed_attachments', []);

        if (empty($removedIds)) {
            return;
        }

        foreach ($removedIds as $mediaId) {
            $media = $project->getMedia('attachments')->find($mediaId);
            if ($media) {
                $media->delete();
            }
        }
    }

    private function attachFiles(Project $project, StoreProjectRequest|UpdateProjectRequest $request): void
    {
        if (! $request->hasFile('attachments')) {
            return;
        }

        foreach ($request->file('attachments') as $file) {
            $project
                ->addMedia($file)
                ->toMediaCollection('attachments');
        }
    }
}
