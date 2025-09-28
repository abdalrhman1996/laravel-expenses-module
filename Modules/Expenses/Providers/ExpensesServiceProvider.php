<?php

namespace Modules\Expenses\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Expenses\Repositories\ExpenseRepositoryInterface;
use Modules\Expenses\Repositories\EloquentExpenseRepository;
use Modules\Expenses\Listeners\SendExpenseCreatedNotification;
use Modules\Expenses\Events\ExpenseCreated;

class ExpensesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ExpenseRepositoryInterface::class, EloquentExpenseRepository::class);
    }

    public function boot(): void
    {

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        $this->app['events']->listen(ExpenseCreated::class, SendExpenseCreatedNotification::class);
    }
}
