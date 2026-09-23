<?php

namespace Shazzoo\Employees\Filament\Resources\EmployeeResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Shazzoo\Employees\Filament\Resources\EmployeeResource;

final class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
}
