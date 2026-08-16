<?php

namespace App\Support;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class CurrencyHelper
{
    /**
     * Format a numeric amount using the Indian numbering system.
     * e.g., 1875000 -> ₹18,75,000
     */
    public static function formatInr(float|int|string|null $amount, bool $withSymbol = true, bool $showDecimals = false): string
    {
        if ($amount === null || $amount === '') {
            return $withSymbol ? '₹0' : '0';
        }

        $num = (float) $amount;
        $isNegative = $num < 0;
        $absNum = abs($num);

        $intPart = (int) floor($absNum);
        $decimalPart = round($absNum - $intPart, 2);

        $intStr = (string) $intPart;
        $len = strlen($intStr);

        if ($len > 3) {
            $lastThree = substr($intStr, -3);
            $rest = substr($intStr, 0, -3);

            // Group the remaining digits into 2s from right to left
            $restFormatted = '';
            while (strlen($rest) > 2) {
                $restFormatted = ','.substr($rest, -2).$restFormatted;
                $rest = substr($rest, 0, -2);
            }
            $restFormatted = $rest.$restFormatted;

            $formatted = $restFormatted.','.$lastThree;
        } else {
            $formatted = $intStr;
        }

        if ($showDecimals && $decimalPart > 0) {
            $decStr = substr(number_format($decimalPart, 2), 1); // e.g. .50
            $formatted .= $decStr;
        }

        $symbol = $withSymbol ? '₹' : '';

        return ($isNegative ? '-' : '').$symbol.$formatted;
    }

    /**
     * Format large amounts into human-friendly Lakh / Crore strings.
     * e.g., 1875000 in 'hi' -> ₹18.75 लाख, in 'en' -> ₹18.75 Lakh
     */
    public static function formatInrShort(float|int|string|null $amount, ?string $locale = null): string
    {
        if ($amount === null || $amount === '') {
            return '₹0';
        }

        $locale = $locale ?: App::getLocale();
        $num = (float) $amount;
        $absNum = abs($num);
        $isNegative = $num < 0;

        $prefix = $isNegative ? '-' : '';

        if ($absNum >= 10000000) {
            $val = round($absNum / 10000000, 2);
            $unit = $locale === 'hi' ? 'करोड़' : 'Cr';

            return "{$prefix}₹{$val} {$unit}";
        }

        if ($absNum >= 100000) {
            $val = round($absNum / 100000, 2);
            $unit = $locale === 'hi' ? 'लाख' : 'Lakh';

            return "{$prefix}₹{$val} {$unit}";
        }

        if ($absNum >= 1000) {
            $val = round($absNum / 1000, 1);
            $unit = $locale === 'hi' ? 'हज़ार' : 'k';

            return "{$prefix}₹{$val} {$unit}";
        }

        return self::formatInr($amount);
    }

    /**
     * Format a date into localized Hindi or English string.
     */
    public static function formatDate(\DateTimeInterface|string|null $date, ?string $locale = null): string
    {
        if (! $date) {
            return '';
        }

        $locale = $locale ?: App::getLocale();
        $carbon = is_string($date) ? Carbon::parse($date) : Carbon::instance($date);

        if ($locale === 'hi') {
            $hindiMonths = [
                1 => 'जनवरी',
                2 => 'फ़रवरी',
                3 => 'मार्च',
                4 => 'अप्रैल',
                5 => 'मई',
                6 => 'जून',
                7 => 'जुलाई',
                8 => 'अगस्त',
                9 => 'सितंबर',
                10 => 'अक्टूबर',
                11 => 'नवंबर',
                12 => 'दिसंबर',
            ];

            $day = $carbon->format('j');
            $month = $hindiMonths[(int) $carbon->format('n')];
            $year = $carbon->format('Y');

            return "{$day} {$month} {$year}";
        }

        return $carbon->format('d F Y');
    }
}
