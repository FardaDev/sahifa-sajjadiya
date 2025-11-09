<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Available Locales
    |--------------------------------------------------------------------------
    |
    | List of all available locales in the application.
    | Add new locale codes here when adding new languages.
    |
    */
    'available' => ['en', 'fa'],

    /*
    |--------------------------------------------------------------------------
    | Default Locale
    |--------------------------------------------------------------------------
    |
    | The default locale that will be used when no locale is specified.
    |
    */
    'default' => 'fa',

    /*
    |--------------------------------------------------------------------------
    | Locale Metadata
    |--------------------------------------------------------------------------
    |
    | Metadata for each locale including display name, native name,
    | flag emoji, and text direction (ltr or rtl).
    |
    */
    'locales' => [
        'en' => [
            'name' => 'English',
            'native' => 'English',
            'flag' => '🇬🇧',
            'dir' => 'ltr',
        ],
        'fa' => [
            'name' => 'Farsi',
            'native' => 'فارسی',
            'flag' => '🇮🇷',
            'dir' => 'rtl',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to any of the locales
    | which will be supported by your application.
    |
    */
    'fallback' => 'en',
];
