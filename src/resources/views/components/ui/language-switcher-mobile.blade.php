{{--
    Language Switcher Component (Mobile)

    A mobile menu version of the language switcher.
    Displays available languages as a list in the mobile menu.

    Usage:
    <x-language-switcher-mobile />
--}}

@php
$locales = config('locales.locales', []);
$currentLocale = app()->getLocale();
@endphp

<div x-data="languageSwitcher()" class="border-t border-gray-200 dark:border-gray-700 pt-2 mt-2">
    <div class="px-4 py-2">
        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
            {{ __('general.language') }}
        </span>
    </div>

    @foreach($locales as $code => $locale)
        <button
            @click="switchLanguage('{{ $code }}')"
            type="button"
            class="w-full flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-300 {{ $code === $currentLocale ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}"
        >
            <span class="text-lg">{{ $locale['flag'] }}</span>
            <span class="flex-1 text-start text-sm font-medium">{{ $locale['native'] }}</span>
            @if($code === $currentLocale)
                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            @endif
        </button>
    @endforeach
</div>
