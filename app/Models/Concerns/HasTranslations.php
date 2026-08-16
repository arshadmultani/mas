<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\App;

trait HasTranslations
{
    /**
     * Get the translated value for a JSON-casted attribute.
     */
    public function trans(string $key, ?string $locale = null): ?string
    {
        $locale = $locale ?: App::getLocale();
        $translations = $this->getAttribute($key);

        if (is_string($translations)) {
            $decoded = json_decode($translations, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $translations = $decoded;
            } else {
                return $translations;
            }
        }

        if (! is_array($translations)) {
            return null;
        }

        return $translations[$locale] ?? $translations['hi'] ?? $translations['en'] ?? reset($translations) ?: '';
    }
}
