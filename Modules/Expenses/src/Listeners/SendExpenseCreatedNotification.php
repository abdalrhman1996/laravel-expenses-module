<?php

namespace Modules\Expenses\Listeners;

use Modules\Expenses\Events\ExpenseCreated;
use Modules\Expenses\Notifications\ExpenseCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendExpenseCreatedNotification implements ShouldQueue
{
    public function handle(ExpenseCreated $event): void
    {

        \Notification::route('mail', config('mail.admin_email', 'admin@example.com'))
            ->notify(new ExpenseCreatedNotification($event->expense));
    }
}
