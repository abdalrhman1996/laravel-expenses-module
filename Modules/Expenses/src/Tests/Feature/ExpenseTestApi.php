<?php

namespace Modules\Expenses\Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Expenses\Models\Expense;
use Illuminate\Support\Str;

class ExpenseApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_and_fetch_and_delete_expense()
    {
        $payload = [
            'title' => 'Patrol for Employees car',
            'amount' => 250,
            'category' => 'Patrol',
            'expense_date' => Carbon::now(),
            'notes' => 'For Programmers Staff '
        ];

        // Create Expense Route
        $createResp = $this->postJson('/api/v1/expenses', $payload);
        $createResp->assertStatus(201)
            ->assertJsonFragment(['title' => 'Patrol for Employees car', 'category' => 'Patrol']);

        $id = $createResp->json('id');

        // Show Expense Route
        $showResp = $this->getJson("/api/v1/expenses/{$id}");
        $showResp->assertStatus(200)
            ->assertJsonPath('title', 'Patrol for Employees car');

        // Delete
        $delResp = $this->deleteJson("/api/v1/expenses/{$id}");
        $delResp->assertStatus(204);

        // Ensure not found
        $this->getJson("/api/v1/expenses/{$id}")->assertStatus(404);
    }
}
