<?php

namespace App\Services;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectService
{
    public function createProject(StoreProjectRequest $request): Project
    {
        $project = Project::create($request->validated());

        if ($request->hasFile('attachments')) {
            $this->attachFiles($project, $request->file('attachments'));
        }

        return $project->load(['user', 'client']);
    }

    public function attachFiles(Project $project, array $files): void
    {
        collect($files)->each(function ($file) use ($project) {
            $project->addMedia($file)->toMediaCollection('attachments');
        });
    }

    public function getProjectAttachments(Project $project): MediaCollection
    {
        return $project->getMedia('attachments');
    }

    public function removeAttachment(Project $project, int $mediaId): bool
    {
        $media = $project->getMedia('attachments')->where('id', $mediaId)->first();

        if ($media) {
            $media->delete();
            return true;
        }

        return false;
    }
}
