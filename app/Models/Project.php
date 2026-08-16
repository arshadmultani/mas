<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'financial_year_id',
        'slug',
        'name',
        'description',
        'budget',
        'status',
        'start_date',
        'end_date',
        'beneficiaries_count',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'array',
            'description' => 'array',
            'budget' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
            'beneficiaries_count' => 'integer',
            'order' => 'integer',
        ];
    }

    public function financialYear(): BelongsTo
    {
        return $this->belongsTo(FinancialYear::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get calculated total spent on this project.
     */
    public function getSpentAmountAttribute(): float
    {
        return (float) $this->expenses()->sum('amount');
    }

    /**
     * Get calculated remaining budget.
     */
    public function getRemainingAmountAttribute(): float
    {
        return max(0, (float) $this->budget - $this->spent_amount);
    }

    /**
     * Get calculated progress percentage.
     */
    public function getProgressPercentageAttribute(): float
    {
        if ($this->budget <= 0) {
            return 0;
        }

        return min(100, round(($this->spent_amount / (float) $this->budget) * 100, 1));
    }
}
