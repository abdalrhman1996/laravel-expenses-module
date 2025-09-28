<?php

namespace Modules\Expenses\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Expense extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'title', 'amount', 'category', 'expense_date', 'notes'
    ];

    protected $casts = [
        'id' => 'string',
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];

}
