# Expenses Module

A modular Expense Management module for Laravel (12). Provides Create, Read, Update, Delete, (CRUD) and filtering (by category and date range) for expenses.

## Features
- Modular structure `Modules/Expenses`
- Expense entity with UUID id, title, amount, category, expense_date, notes, timestamps
- API routes (JSON)
- Form Requests for validation
- Eloquent Model
- Repository pattern (interface + Eloquent implementation)
- Service layer that fires `ExpenseCreated` event
- Event listener that dispatches a sample notification (`ExpenseCreatedNotification`)
- Laravel API Resources for formatting responses
- Example Feature test

## Installation / Setup

1. Copy the `Modules/Expenses` folder into your project root.

2. Ensure autoloading:
   - Option A: Add the PSR-4 mapping from `Modules/Expenses/composer.json` into your project's `composer.json`:
     ```json
     "psr-4": {
         "Modules\\Expenses\\": "Modules/Expenses/src/"
     }
     ```
     then run `composer dump-autoload`.

   - Option B: Require the module as a composer package (if published).

3. Register the service provider:
   - Add `\Modules\Expenses\Providers\ExpensesServiceProvider::class` to `config/app.php` -> `providers` (or via your module loader).

4. Migrate:
   ```bash
   php artisan migrate




## API Endpoints (prefix /api/v1/expenses)

1. GET / — list (supports category, date_from, date_to, search, per_page)

2. POST / — create

3. GET /{id} — show

4. PUT|PATCH /{id} — update

5. DELETE /{id} — delete



## Assumptions & Decisions

1. Categories are validated via in: in FormRequest: travel, office, food, utilities, other. Replace or externalize to a config or enum as needed.

2. UUID primary key is used via Laravel HasUuids.

3. The module uses a simple repository implementation; for more complex projects, consider abstracting queries further.

4. Events and Notifications are provided as examples. SendExpenseCreatedNotification routes to a configured admin email — adapt to your user management.

5. The service provider binds the repository interface to the Eloquent implementation.
