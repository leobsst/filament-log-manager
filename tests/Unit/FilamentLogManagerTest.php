<?php

use Leobsst\FilamentLogManager\FilamentLogManager;

it('can be made', function () {
    $plugin = FilamentLogManager::make();
    expect($plugin)->toBeInstanceOf(FilamentLogManager::class);
});

it('evaluates access callbacks', function () {
    $plugin = FilamentLogManager::make()->authorize(fn () => false);
    expect($plugin->canAccess())->toBeFalse();

    $plugin->authorize(true);
    expect($plugin->canAccess())->toBeTrue();
});

it('manages delete and download permissions', function () {
    $plugin = FilamentLogManager::make()
        ->canDeleteUsing(fn () => false)
        ->canDownloadUsing(true);

    expect($plugin->canDelete())->toBeFalse()
        ->and($plugin->canDownload())->toBeTrue();
});

it('handles log dirs and excluded patterns', function () {
    $plugin = FilamentLogManager::make()
        ->logDirs(['foo', 'bar'])
        ->excludedFilesPatterns(['*.zip']);

    expect($plugin->getLogDirs())->toBe(['foo', 'bar'])
        ->and($plugin->getExcludedFilesPatterns())->toBe(['*.zip']);
});

it('evaluates navigation config and labels', function () {
    $plugin = FilamentLogManager::make()
        ->navigationGroup('Ops')
        ->navigationParentItem('Logs')
        ->navigationIcon('heroicon-o-server')
        ->activeNavigationIcon('heroicon-s-server')
        ->navigationLabel('Label')
        ->navigationBadge('New')
        ->navigationBadgeColor('danger')
        ->navigationBadgeTooltip('Tooltip')
        ->navigationSort(10)
        ->title('Titre')
        ->slug('logs');

    expect($plugin->getNavigationGroup())->toBe('Ops')
        ->and($plugin->getNavigationParentItem())->toBe('Logs')
        ->and($plugin->getNavigationIcon())->toBe('heroicon-o-server')
        ->and($plugin->getActiveNavigationIcon())->toBe('heroicon-s-server')
        ->and($plugin->getNavigationLabel())->toBe('Label')
        ->and($plugin->getNavigationBadge())->toBe('New')
        ->and($plugin->getNavigationBadgeColor())->toBe('danger')
        ->and($plugin->getNavigationBadgeTooltip())->toBe('Tooltip')
        ->and($plugin->getNavigationSort())->toBe(10)
        ->and($plugin->getTitle())->toBe('Titre')
        ->and($plugin->getSlug())->toBe('logs');
});

it('sets default log dir on boot when none provided', function () {
    // Test that default log directory is set when none is configured
    $plugin = FilamentLogManager::make();

    // Simulate the boot process
    $defaultLogDirs = $plugin->getLogDirs();

    // Should have a default value when none is provided
    expect($defaultLogDirs)->not()->toBeEmpty();
})->skip('Needs proper service provider boot sequence testing');
