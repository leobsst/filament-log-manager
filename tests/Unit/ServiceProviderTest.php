<?php

use Leobsst\FilamentLogManager\FilamentLogManagerServiceProvider;

it('computes asset package name', function () {
    $sp = new FilamentLogManagerServiceProvider(app());
    $ref = new ReflectionClass($sp);
    $m = $ref->getMethod('getAssetPackageName');
    $m->setAccessible(true);

    expect($m->invoke($sp))->toBe('leobsst/filament-log-manager');
});
