<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocietyStat extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'key',
        'label',
        'value',
        'subtext',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'label' => 'array',
            'subtext' => 'array',
            'order' => 'integer',
        ];
    }
}
