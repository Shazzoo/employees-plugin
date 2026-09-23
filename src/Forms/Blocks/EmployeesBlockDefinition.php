<?php

namespace Shazzoo\Employees\Forms\Blocks;

use Shazzoo\ContentStudioCore\Support\Blocks\BlockDefinition;
use Shazzoo\ContentStudioCore\Support\Fields\Definitions\SelectField;
use Shazzoo\ContentStudioCore\Support\Fields\Definitions\TextInput;
use Shazzoo\ContentStudioCore\Support\Fields\Definitions\TextareaField;

final class EmployeesBlockDefinition
{
    public static function definition(): BlockDefinition
    {
        return BlockDefinition::make('employees.employees')
            ->label('Employees')
            ->description('Shows employees managed in the Employees plugin.')
            ->group('Plugins')
            ->icon('heroicon-o-users')
            ->schema([
                TextInput::make('label')
                    ->label('Label')
                    ->default('Our team')
                    ->columnSpan(6),
                SelectField::make('background')
                    ->label('Background')
                    ->options([
                        'white' => 'White',
                        'ground' => 'Ground',
                        'dark' => 'Dark',
                    ])
                    ->default('white')
                    ->columnSpan(6),
                TextInput::make('title')
                    ->label('Title')
                    ->default('Our team')
                    ->columnSpan(12),
                TextareaField::make('note')
                    ->label('Note below the team')
                    ->rows(3)
                    ->columnSpan(12),
                SelectField::make('limit')
                    ->label('Employees to show')
                    ->options([
                        'all' => 'All employees',
                        '3' => '3 employees',
                        '6' => '6 employees',
                        '9' => '9 employees',
                    ])
                    ->default('all')
                    ->columnSpan(6),
            ]);
    }
}
