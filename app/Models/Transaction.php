<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'financial_year_id',
        'project_id',
        'date',
        'type', // income, expense
        'category',
        'category_name',
        'description',
        'amount',
        'reference_no',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'category_name' => 'array',
            'description' => 'array',
            'amount' => 'decimal:2',
        ];
    }

    public function financialYear(): BelongsTo
    {
        return $this->belongsTo(FinancialYear::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
