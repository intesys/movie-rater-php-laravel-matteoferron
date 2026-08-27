<?php

// Stub per l'IDE: Pest definisce queste funzioni a runtime.
// Questo file NON viene eseguito (è fuori dai testsuite PHPUnit/Pest),
// ma aiuta l'LSP a non segnalare le funzioni come non definite.

if (! function_exists('it')) {
    function it(?string $description = null, ?\Closure $test = null): mixed {}
}

if (! function_exists('test')) {
    function test(?string $description = null, ?\Closure $test = null): mixed {}
}

if (! function_exists('beforeEach')) {
    function beforeEach(?\Closure $closure = null): mixed {}
}

if (! function_exists('afterEach')) {
    function afterEach(?\Closure $closure = null): mixed {}
}

if (! function_exists('beforeAll')) {
    function beforeAll(?\Closure $closure = null): mixed {}
}

if (! function_exists('afterAll')) {
    function afterAll(?\Closure $closure = null): mixed {}
}

if (! function_exists('uses')) {
    function uses(...$traits): mixed {}
}

if (! function_exists('expect')) {
    function expect(mixed $value = null): mixed {}
}

if (! function_exists('dataset')) {
    function dataset(string $name, \Closure|iterable $dataset = []): void {}
}

if (! function_exists('describe')) {
    function describe(string $description, \Closure $tests): mixed {}
}
