<?php

namespace Leobsst\FilamentLogManager\Pages\Actions;

use Filament\Actions\Action;
use Leobsst\FilamentLogManager\Pages\Logs;

class JumpToStartAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'jumpToStart';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-arrow-uturn-up')->color('gray');

        $this->tooltip(__('filament-log-manager::translations.actions.jumpToStart.label'));

        $this->hiddenLabel();

        $this->livewireClickHandlerEnabled(false);

        $this->disabled(
            fn (Logs $livewire): bool => ! (bool) $livewire->logFile
        );
    }
}
