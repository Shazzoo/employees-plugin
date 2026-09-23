<?php

namespace Shazzoo\Employees\Models;

use FinnWiel\ShazzooMedia\Models\ShazzooMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Shazzoo\Employees\Database\Factories\EmployeeFactory;

final class Employee extends Model
{
    /** @use HasFactory<EmployeeFactory> */
    use HasFactory;

    protected $table = 'content_studio_employees';

    protected $fillable = [
        'image_id',
        'name',
        'role',
        'skills',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
        ];
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
