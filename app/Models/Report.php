<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'financial_year_id',
        'title',
        'type', // financial, activity, audit, budget
        'file_path',
        'file_size',
        'published_at',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'published_at' => 'date',
            'order' => 'integer',
        ];
    }

    public function financialYear(): BelongsTo
    {
        return $this->belongsTo(FinancialYear::class);
    }
}
