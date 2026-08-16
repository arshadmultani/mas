<?php

use App\Support\CurrencyHelper;

if (! function_exists('format_inr')) {
    function format_inr(float|int|string|null $amount, bool $withSymbol = true, bool $showDecimals = false): string
    {
        return CurrencyHelper::formatInr($amount, $withSymbol, $showDecimals);
    }
}

if (! function_exists('format_inr_short')) {
    function format_inr_short(float|int|string|null $amount, ?string $locale = null): string
    {
        return CurrencyHelper::formatInrShort($amount, $locale);
    }
}

if (! function_exists('format_date_localized')) {
    function format_date_localized(DateTimeInterface|string|null $date, ?string $locale = null): string
    {
        return CurrencyHelper::formatDate($date, $locale);
    }
}
