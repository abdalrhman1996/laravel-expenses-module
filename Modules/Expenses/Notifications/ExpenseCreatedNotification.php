<?php

namespace Modules\Expenses\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Expenses\Models\Expense;

class ExpenseCreatedNotification extends Notification
{
    use Queueable;

    protected Expense $expense;

    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {

    }

    public function toDatabase($notifiable)
    {
        return [
            'expense_id' => $this->expense->id,
            'title' => $this->expense->title,
            'amount' => $this->expense->amount,
            'category' => $this->expense->category,
        ];
    }
}
