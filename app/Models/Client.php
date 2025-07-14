<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read int $id
 * @property-read string $contact_name
 * @property-read string $contact_email
 * @property-read string $contact_phone_number
 * @property-read string $company_name
 * @property-read string $company_address
 * @property-read string $company_city
 * @property-read string $company_zip
 * @property-read int $company_vat
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 * @property-read CarbonImmutable $deleted_at
 */
final class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'contact_name',
        'contact_email',
        'contact_phone_number',
        'company_name',
        'company_address',
        'company_city',
        'company_zip',
        'company_vat',
    ];

    public function companyName(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucfirst($value),
        );
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
