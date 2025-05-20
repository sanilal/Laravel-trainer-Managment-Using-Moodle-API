<?php

if (!function_exists('langContent')) {
    function langContent($content)
    {
        if (!$content) {
            return ''; // return empty if content is null
        }

        // Check if {mlang} tags exist
        if (strpos($content, '{mlang') !== false) {
            // Find current app locale
            $locale = app()->getLocale();
            $locale = strtolower($locale);

            // Match {mlang EN}...{mlang} or {mlang AR}...{mlang}
            preg_match_all('/\{mlang\s*' . strtoupper($locale) . '\}(.*?)\{mlang\}/is', $content, $matches);

            if (!empty($matches[1])) {
                return trim($matches[1][0]);
            } else {
                return ''; // No match found for current language
            }
        } else {
            // No {mlang} tags, return content directly
            return $content;
        }
    }
}

