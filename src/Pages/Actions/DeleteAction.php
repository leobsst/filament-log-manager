<?php

namespace Leobsst\FilamentLogManager\Pages\Actions;

use Filament\Actions\Action;
use Leobsst\FilamentLogManager\Pages\Logs;

class DeleteAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'delete';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-trash')->color('danger');

        $this->tooltip(__('filament-log-manager::translations.actions.delete.label'));

        $this->hiddenLabel();

        $this->requiresConfirmation()
            ->modalHeading(__('filament-log-manager::translations.actions.delete.modal.heading'))
            ->modalDescription(__('filament-log-manager::translations.actions.delete.modal.description'))
            ->modalSubmitActionLabel(__('filament-log-manager::translations.actions.delete.modal.actions.confirm'));

        $this->action(fn (Logs $livewire) => $livewire->delete());

        $this->visible(fn (Logs $livewire): bool => $livewire->isDeletable() && $livewire->canDelete());

        $this->disabled(fn (Logs $livewire): bool => ! (bool) $livewire->logFile);

        $this->successNotificationTitle(__('filament-log-manager::translations.actions.delete.flash.success'));
    }
}
