<?php

namespace Modules\Expenses\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use Modules\Expenses\Services\ExpenseService;
use Modules\Expenses\Http\Requests\StoreExpenseRequest;
use Modules\Expenses\Http\Requests\UpdateExpenseRequest;
use Modules\Expenses\Http\Resources\ExpenseResource;
use Modules\Expenses\Http\Resources\ExpenseCollection;

class ExpenseController extends Controller
{
    protected ExpenseService $service;

    public function __construct(ExpenseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $filters = request()->only(['category', 'date_from', 'date_to', 'search']);
        $perPage = (int) request()->get('per_page', 15);

        $paginator = $this->service->listExpenses($filters, $perPage);

        return (new ExpenseCollection($paginator))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = $this->service->createExpense($request->validated());

        return (new ExpenseResource($expense))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        $expense = $this->service->getExpense($id);
        if (!$expense) {
            return response()->json(['message' => 'Expense not found'], Response::HTTP_NOT_FOUND);
        }
        return (new ExpenseResource($expense))->response()->setStatusCode(Response::HTTP_OK);
    }

    public function update(UpdateExpenseRequest $request, string $id)
    {
        $expense = $this->service->updateExpense($id, $request->validated());
        if (!$expense) {
            return response()->json(['message' => 'Expense not found'], Response::HTTP_NOT_FOUND);
        }
        return (new ExpenseResource($expense))->response()->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(string $id)
    {
        $deleted = $this->service->deleteExpense($id);
        if (!$deleted) {
            return response()->json(['message' => 'Expense not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
