<?php

namespace Shazzoo\Employees\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use FinnWiel\ShazzooMedia\Traits\HandlesConversions;
use Shazzoo\Employees\Filament\Resources\EmployeeResource;

final class EditEmployee extends EditRecord
{
    // Maakt de conversies aan die het fotoveld vraagt; zonder deze trait
    // doet ->conversions() op de picker niets.
    use HandlesConversions;

    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
