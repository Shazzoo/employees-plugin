<?php

namespace Shazzoo\Employees\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Shazzoo\Employees\Filament\Resources\EmployeeResource;

final class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
