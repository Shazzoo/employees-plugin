<?php

namespace Shazzoo\Employees;

final class Plugin
{
    public static function key(): string
    {
        return 'shazzoo/employees';
    }

    public static function provider(): string
    {
        return EmployeesServiceProvider::class;
    }
}
