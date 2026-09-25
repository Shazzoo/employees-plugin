<?php

namespace Shazzoo\Employees\Models;

use FinnWiel\ShazzooMedia\Models\ShazzooMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Shazzoo\ContentStudioCore\Support\Localization\HasTranslations;
use Shazzoo\Employees\Database\Factories\EmployeeFactory;

final class Employee extends Model
{
    /** @use HasFactory<EmployeeFactory> */
    use HasFactory;

    use HasTranslations;

    protected $table = 'content_studio_employees';

    protected $fillable = [
        'locale',
        'translation_key',
        'image_id',
        'name',
        'role',
        'skills',
        'sort_order',
    ];

    protected function skills(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value): array => self::normalizeSkills($value),
            set: fn (mixed $value): string => json_encode(self::normalizeSkills($value), JSON_THROW_ON_ERROR),
        );
    }

    protected function casts(): array
    {
        return ['sort_order' => 'integer'];
    }

    /** @return array<int, string> */
    private static function normalizeSkills(mixed $skills): array
    {
        if (is_string($skills)) {
            $decodedSkills = json_decode($skills, true);
            $skills = is_array($decodedSkills) ? $decodedSkills : explode(',', $skills);
        }

        if (! is_array($skills)) {
            return [];
        }

        return array_values(array_filter(
            array_map(fn (mixed $skill): string => trim((string) $skill), $skills),
            fn (string $skill): bool => $skill !== '',
        ));
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(ShazzooMedia::class, 'image_id');
    }

    protected static function newFactory(): EmployeeFactory
    {
        return EmployeeFactory::new();
    }
}
