<?php

namespace Modules\Expenses\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Expenses\Models\Expense;

interface ExpenseRepositoryInterface
{
    public function createExpense(array $data): Expense;
    public function findExpenseByID(string $id): ?Expense;
    public function updateExpense(string $id, array $data): ?Expense;
    public function deleteExpense(string $id): bool;
    public function listExpenses(array $filters = [], int $perPage = 15): LengthAwarePaginator;
}
