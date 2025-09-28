<?php

namespace Modules\Expenses\Services;

use Modules\Expenses\Models\Expense;
use Modules\Expenses\Repositories\ExpenseRepositoryInterface;
use Modules\Expenses\Events\ExpenseCreated;

class ExpenseService
{
    protected ExpenseRepositoryInterface $repo;

    public function __construct(ExpenseRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function createExpense(array $data): Expense
    {
        $expense = $this->repo->createExpense($data);

        // Fire event
        event(new ExpenseCreated($expense));

        return $expense;
    }

    public function getExpense(string $id): ?Expense
    {
        return $this->repo->findExpenseByID($id);
    }

    public function updateExpense(string $id, array $data): ?Expense
    {
        return $this->repo->updateExpense($id, $data);
    }

    public function deleteExpense(string $id): bool
    {
        return $this->repo->deleteExpense($id);
    }

    public function listExpenses(array $filters = [], int $perPage = 15)
    {
        return $this->repo->listExpenses($filters, $perPage);
    }
}
