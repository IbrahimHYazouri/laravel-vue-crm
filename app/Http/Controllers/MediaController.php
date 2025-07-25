<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class MediaController extends Controller
{
    public function download(Media $media): BinaryFileResponse
    {
        return response()->download($media->getPath(), $media->file_name);
    }
}
