<?php

use Leobsst\FilamentLogManager\Pages\Actions\DeleteAction;
use Leobsst\FilamentLogManager\Pages\Actions\DownloadAction;
use Leobsst\FilamentLogManager\Pages\Actions\JumpToEndAction;
use Leobsst\FilamentLogManager\Pages\Actions\JumpToStartAction;
use Leobsst\FilamentLogManager\Pages\Actions\RefreshAction;

it('has default names', function () {
    expect(DeleteAction::getDefaultName())->toBe('delete')
        ->and(DownloadAction::getDefaultName())->toBe('download')
        ->and(RefreshAction::getDefaultName())->toBe('refresh')
        ->and(JumpToStartAction::getDefaultName())->toBe('jumpToStart')
        ->and(JumpToEndAction::getDefaultName())->toBe('jumpToEnd');
});
