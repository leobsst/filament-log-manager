<?php

use Filament\Actions\Action;
use Leobsst\FilamentLogManager\Pages\Logs;

it('allows modifying actions via callbacks', function () {
    $page = app(Logs::class);

    $page->modifyRefreshAction(function (Action $action) {
        return $action->label('Reload');
    });

    $action = $page->refreshAction();
    expect($action)->toBeInstanceOf(Action::class);
});

it('configures alpine handlers on jump actions', function () {
    $page = app(Logs::class);

    $start = $page->jumpToStartAction();
    $end = $page->jumpToEndAction();

    expect($start)->toBeInstanceOf(Action::class)
        ->and($end)->toBeInstanceOf(Action::class);
});
