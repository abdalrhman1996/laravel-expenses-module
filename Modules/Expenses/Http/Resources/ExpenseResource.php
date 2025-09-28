<?php

namespace Modules\Expenses\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (string)$this->id,
            'title' => $this->title,
            'amount' => $this->amount,
            'category' => $this->category,
            'expense_date' => $this->expense_date ? $this->expense_date->toDateString() : null,
            'notes' => $this->notes,
            'created_at' => $this->created_at ? $this->created_at->toAtomString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->toAtomString() : null,
        ];
    }
}
