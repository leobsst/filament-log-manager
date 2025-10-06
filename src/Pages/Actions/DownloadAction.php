<?php

namespace Leobsst\FilamentLogManager\Pages\Actions;

use Filament\Actions\Action;
use Leobsst\FilamentLogManager\Pages\Logs;

class DownloadAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'download';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-arrow-down-tray')->color('primary');

        $this->tooltip(__('filament-log-manager::translations.actions.download.label'));

        $this->hiddenLabel();

        $this->visible(fn (Logs $livewire) => $livewire->canDownload());

        $this->action(fn (Logs $livewire) => $livewire->download());

        $this->disabled(
            fn (Logs $livewire): bool => ! (bool) $livewire->logFile
        );
    }
}
