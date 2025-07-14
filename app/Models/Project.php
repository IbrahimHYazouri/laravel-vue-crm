<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProjectStatus;
use Carbon\CarbonImmutable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property-read int $id
 * @property-read string $title
 * @property-read string $description
 * @property-read int $client_id
 * @property-read int $user_id
 * @property-read DateTimeInterface $deadline
 * @property-read string $status
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 * @property-read CarbonImmutable $deleted_at
 */
final class Project extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'user_id',
        'client_id',
    ];

    protected $appends = ['deadline_formatted', 'created_at_formatted'];

    public function deadlineFormatted(): Attribute
    {
        return Attribute::get(fn () => $this->deadline?->format('Y-m-d')
        );
    }

    public function createdAtFormatted(): Attribute
    {
        return Attribute::get(fn () => $this->created_at?->format('Y-m-d')
        );
    }

    public function casts(): array
    {
        return [
            'status' => ProjectStatus::class,
            'deadline' => 'datetime',
        ];
    }

    #[Scope]
    public function filterStatus(Builder $query, ?ProjectStatus $status = null): Builder
    {
        return $query->when($status, function ($query, $status) {
            return $query->where('status', $status);
        });
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('attachments')
            ->useDisk('public')           // or whichever disk you prefer
            ->acceptsMimeTypes([
                'application/pdf',
                'image/jpeg',
                'image/png',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ])
            ->withResponsiveImages();    // if you want image conversions
    }
}
