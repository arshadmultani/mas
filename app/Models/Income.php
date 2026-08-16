<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'financial_year_id',
        'date',
        'category',
        'category_name',
        'description',
        'source',
        'amount',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'category_name' => 'array',
            'description' => 'array',
            'source' => 'array',
            'amount' => 'decimal:2',
        ];
    }

    public function financialYear(): BelongsTo
    {
        return $this->belongsTo(FinancialYear::class);
    }
}
