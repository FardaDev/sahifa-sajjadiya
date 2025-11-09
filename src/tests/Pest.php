<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');

pest()->extend(Tests\TestCase::class)
    ->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}

/*
|--------------------------------------------------------------------------
| Architecture Tests
|--------------------------------------------------------------------------
|
| Architecture tests ensure that the codebase follows Laravel and Filament
| conventions and best practices. These tests run automatically with the
| test suite and help maintain code quality and consistency.
|
*/

// Models should extend Eloquent Model
arch('models')
    ->expect('App\Models')
    ->toExtend('Illuminate\Database\Eloquent\Model')
    ->toOnlyBeUsedIn([
        'App\Models',
        'App\Http\Controllers',
        'App\Filament\Resources',
        'App\Policies',
        'Database\Factories',
        'Database\Seeders',
    ]);

// Controllers should have Controller suffix and be in correct namespace
arch('controllers')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller')
    ->toOnlyBeUsedIn([
        'App\Http\Controllers',
        'App\Providers',
    ]);

// Filament resources should follow naming conventions
arch('filament resources')
    ->expect('App\Filament\Resources')
    ->toHaveSuffix('Resource')
    ->toExtend('Filament\Resources\Resource');

// Prevent debugging functions in production code
arch('no debugging functions')
    ->expect(['dd', 'dump', 'ray', 'var_dump', 'print_r'])
    ->not->toBeUsed();

// Ensure strict types are declared
arch('strict types')
    ->expect('App')
    ->toUseStrictTypes();

// Ensure no exit or die statements
arch('no exit or die')
    ->expect(['exit', 'die'])
    ->not->toBeUsed();
