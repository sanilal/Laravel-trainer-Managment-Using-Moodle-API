<?php

namespace App\Helpers;

class LanguageContentHelper
{
    public static function extract($text, $locale = null)
    {
        if (!$locale) {
            $locale = app()->getLocale(); // Get current app language (Laravel locale)
        }

        // Match all language blocks
        preg_match_all('/\{mlang\s([A-Z]+)\}(.*?)\{mlang\}/s', $text, $matches, PREG_SET_ORDER);

        $contentByLang = [];
        
        foreach ($matches as $match) {
            $lang = strtolower($match[1]); // 'en' or 'ar'
            $content = trim($match[2]);
            $contentByLang[$lang] = $content;
        }

        // If content for current locale exists, return it
        if (isset($contentByLang[$locale])) {
            return $contentByLang[$locale];
        }

        // Otherwise, if only one language exists, return it
        if (count($contentByLang) === 1) {
            return reset($contentByLang); // First and only element
        }

        // Otherwise, return the full original text (or blank)
        return '';
    }
}
