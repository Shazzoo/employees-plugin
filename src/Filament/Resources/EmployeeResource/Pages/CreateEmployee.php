<?php

namespace Shazzoo\Employees\Filament\Resources\EmployeeResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use FinnWiel\ShazzooMedia\Traits\HandlesConversions;
use Shazzoo\Employees\Filament\Resources\EmployeeResource;

final class CreateEmployee extends CreateRecord
{
    // Maakt de conversies aan die het fotoveld vraagt; zonder deze trait
    // doet ->conversions() op de picker niets.
    use HandlesConversions;

    protected static string $resource = EmployeeResource::class;
}
