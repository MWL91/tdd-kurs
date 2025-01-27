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

use Mwl91\Tests\Tdd\FleetTestCase;

pest()->extend(FleetTestCase::class)->in('Unit');

pest()->extend(FleetTestCase::class)->beforeAll(function () {
    // Runs before each file...
})->beforeEach(function () {
    // Runs before each test...
})->afterEach(function () {
    // Runs after each test...
})->afterAll(function () {
    // Runs after each file...
})->group('integration')->in('Feature');

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
