<?php

namespace Shazzoo\Employees;

use Illuminate\Support\ServiceProvider;

final class EmployeesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $basePath = dirname(__DIR__);

        $this->loadMigrationsFrom($basePath.'/database/migrations');
        $this->loadViewsFrom($basePath.'/resources/views', 'employees');

        $this->publishes([
            $basePath.'/resources/views' => resource_path('views/vendor/employees'),
        ], 'employees-views');

    }
}
