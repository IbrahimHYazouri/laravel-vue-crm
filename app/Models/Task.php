<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'client_id',
        'project_id',
        'user_id',
        'deadline',
        'status',
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
            'status' => TaskStatus::class,
            'deadline' => 'datetime',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    #[Scope]
    protected function filterStatus(Builder $query, ?TaskStatus $status = null): Builder
    {
        return $query->when($status, function ($query, $status) {
            return $query->where('status', $status);
        });
    }
}
