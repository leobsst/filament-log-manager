<?php

namespace Leobsst\FilamentLogManager\Pages\Actions;

use Filament\Actions\Action;
use Leobsst\FilamentLogManager\Pages\Logs;

class RefreshAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'refresh';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-arrow-path-rounded-square')->color('info');

        $this->tooltip(__('filament-log-manager::translations.actions.refresh.label'));

        $this->hiddenLabel();

        $this->action(fn (Logs $livewire) => $livewire->refresh());

        $this->disabled(
            fn (Logs $livewire): bool => ! (bool) $livewire->logFile
        );
    }
}
