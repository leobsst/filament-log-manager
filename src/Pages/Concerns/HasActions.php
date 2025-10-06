<?php

namespace Leobsst\FilamentLogManager\Pages\Concerns;

use Closure;
use Filament\Actions\Action;
use Filament\Support\Concerns\EvaluatesClosures;
use Leobsst\FilamentLogManager\Pages\Actions\DeleteAction;
use Leobsst\FilamentLogManager\Pages\Actions\DownloadAction;
use Leobsst\FilamentLogManager\Pages\Actions\JumpToEndAction;
use Leobsst\FilamentLogManager\Pages\Actions\JumpToStartAction;
use Leobsst\FilamentLogManager\Pages\Actions\RefreshAction;

trait HasActions
{
    use EvaluatesClosures;

    protected bool | Closure $isDeletable = true;

    protected ?Closure $modifyDeleteActionUsing = null;

    protected ?Closure $modifyDownloadActionUsing = null;

    protected ?Closure $modifyJumpToStartActionUsing = null;

    protected ?Closure $modifyJumpToEndActionUsing = null;

    protected ?Closure $modifyRefreshActionUsing = null;

    public function deleteAction(): Action
    {
        $action = DeleteAction::make();

        if ($this->modifyDeleteActionUsing) {
            $action = $this->evaluate($this->modifyDeleteActionUsing, [
                'action' => $action,
            ]) ?? $action;
        }

        return $action;
    }

    public function downloadAction(): Action
    {
        $action = DownloadAction::make();

        if ($this->modifyDownloadActionUsing) {
            $action = $this->evaluate($this->modifyDownloadActionUsing, [
                'action' => $action,
            ]) ?? $action;
        }

        return $action;
    }

    public function jumpToStartAction(): Action
    {
        $action = JumpToStartAction::make();

        if ($this->modifyJumpToStartActionUsing) {
            $action = $this->evaluate($this->modifyJumpToStartActionUsing, [
                'action' => $action,
            ]) ?? $action;
        }

        $action->alpineClickHandler('jumpToStart');

        return $action;
    }

    public function jumpToEndAction(): Action
    {
        $action = JumpToEndAction::make();

        if ($this->modifyJumpToEndActionUsing) {
            $action = $this->evaluate($this->modifyJumpToEndActionUsing, [
                'action' => $action,
            ]) ?? $action;
        }

        $action->alpineClickHandler('jumpToEnd');

        return $action;
    }

    public function refreshAction(): Action
    {
        $action = RefreshAction::make();

        if ($this->modifyRefreshActionUsing) {
            $action = $this->evaluate($this->modifyRefreshActionUsing, [
                'action' => $action,
            ]) ?? $action;
        }

        return $action;
    }

    public function modifyDeleteAction(?Closure $callback): static
    {
        $this->modifyDeleteActionUsing = $callback;

        return $this;
    }

    public function modifyDownloadAction(?Closure $callback): static
    {
        $this->modifyDownloadActionUsing = $callback;

        return $this;
    }

    public function modifyJumpToStartAction(?Closure $callback): static
    {
        $this->modifyJumpToStartActionUsing = $callback;

        return $this;
    }

    public function modifyJumpToEndAction(?Closure $callback): static
    {
        $this->modifyJumpToEndActionUsing = $callback;

        return $this;
    }

    public function modifyRefreshAction(?Closure $callback): static
    {
        $this->modifyRefreshActionUsing = $callback;

        return $this;
    }

    public function isDeletable(): bool
    {
        return $this->evaluate($this->isDeletable);
    }
}
