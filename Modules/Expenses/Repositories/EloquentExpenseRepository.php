<?php

namespace Modules\Expenses\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Expenses\Models\Expense;

class EloquentExpenseRepository implements ExpenseRepositoryInterface
{
    public function createExpense(array $data): Expense
    {
        return Expense::create($data);
    }

    public function findExpenseByID(string $id): ?Expense
    {
        return Expense::find($id);
    }

    public function updateExpense(string $id, array $data): ?Expense
    {
        $expense = $this->find($id);
        if (!$expense) return null;
        $expense->update($data);
        return $expense;
    }

    public function deleteExpense(string $id): bool
    {
        $expense = $this->find($id);
        if (!$expense) return false;
        return $expense->delete();
    }

    public function listExpenses(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Expense::query();

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (!empty($filters['date_from'])) {
            $query->where('expense_date', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->where('expense_date', '<=', $filters['date_to']);
        }

        if (!empty($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }

        return $query->orderBy('expense_date', 'desc')->paginate($perPage);
    }
}
