<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FinancialYear extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'label',
        'start_date',
        'end_date',
        'target_amount',
        'previous_year_income',
        'is_current',
    ];

    protected function casts(): array
    {
        return [
            'label' => 'array',
            'start_date' => 'date',
            'end_date' => 'date',
            'target_amount' => 'decimal:2',
            'previous_year_income' => 'decimal:2',
            'is_current' => 'boolean',
        ];
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class)->orderBy('order');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class)->orderBy('order');
    }
}
