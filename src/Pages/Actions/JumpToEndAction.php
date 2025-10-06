<?php

namespace Leobsst\FilamentLogManager\Pages\Actions;

use Filament\Actions\Action;
use Leobsst\FilamentLogManager\Pages\Logs;

class JumpToEndAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'jumpToEnd';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-arrow-uturn-down')->color('gray');

        $this->tooltip(__('filament-log-manager::translations.actions.jumpToEnd.label'));

        $this->hiddenLabel();

        $this->livewireClickHandlerEnabled(false);

        $this->disabled(
            fn (Logs $livewire): bool => ! (bool) $livewire->logFile
        );
    }
}
