<?php

namespace Leobsst\FilamentLogManager\Pages;

use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Leobsst\FilamentLogManager\FilamentLogManager;
use Leobsst\FilamentLogManager\Pages\Concerns\HasActions;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use UnitEnum;

class Logs extends Page
{
    use HasActions;

    protected string $view = 'filament-log-manager::pages.logs';

    public ?string $logFile = null;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                $this->getSelectComponent(),
            ]);
    }

    protected function getSelectComponent(): Component
    {
        $component = Select::make('logFile')
            ->hiddenLabel()
            ->placeholder(__('filament-log-manager::translations.page.form.placeholder'))
            ->live()
            ->options($this->getSelectOptions())
            ->searchable()
            ->afterStateUpdated(fn () => $this->refresh());

        if ($this->hasLimit()) {
            $component->getSearchResultsUsing(
                fn (string $query) => $this->getFileNames($this->getFinder()->name("*{$query}*"))
            );
        }

        return $component;
    }

    public function read(): string
    {
        if (! $this->logFile || ! $this->fileResidesInLogDirs($this->logFile) || $this->fileIsTooLarge($this->logFile)) {

            return '';
        }

        return File::get($this->logFile);
    }

    public function delete(): void
    {
        if (! $this->logFile || ! $this->fileResidesInLogDirs($this->logFile)) {
            $this->logFile = null;

            return;
        }

        File::delete($this->logFile);
        $this->logFile = null;

        $this->refresh();
    }

    public function download(): ?BinaryFileResponse
    {
        if (! $this->logFile || ! $this->fileResidesInLogDirs($this->logFile)) {
            $this->logFile = null;

            return null;
        }

        return response()->download($this->logFile);
    }

    public function refresh(): void
    {
        $this->dispatch('logContentUpdated', content: $this->read());
    }

    protected function fileResidesInLogDirs(string $logFile): bool
    {
        return collect(FilamentLogManager::get()->getLogDirs())
            ->contains(fn (string $logDir) => str_contains($logFile, $logDir));
    }

    protected function getFinder(): Finder
    {
        return Finder::create()
            ->ignoreDotFiles(true)
            ->ignoreUnreadableDirs()
            ->files()
            ->in(FilamentLogManager::get()->getLogDirs())
            ->notName(FilamentLogManager::get()->getExcludedFilesPatterns());
    }

    protected function getFileNames($files): Collection
    {
        return collect($files)->mapWithKeys(function (SplFileInfo $file) {
            return [$file->getRealPath() => $file->getRealPath()];
        });
    }

    protected function getSelectOptions(): Collection
    {
        $options = $this->getFileNames($this->getFinder());

        if ($this->hasLimit()) {
            $options = $options->take(config('filament-log-manager.limit'));
        }

        return $options;
    }

    protected function hasLimit(): bool
    {
        return ! in_array(config('filament-log-manager.limit'), ['-1', null, 0]);
    }

    protected function fileIsTooLarge(string $logFile): bool
    {
        $isTooLarge = File::size($logFile) > config('filament-log-manager.max_file_size');

        if ($isTooLarge) {
            Notification::make()
                ->title(__('filament-log-manager::translations.file_is_too_large'))
                ->color('danger')
                ->icon('heroicon-s-exclamation-circle')
                ->iconColor('danger')
                ->send();
        }

        return $isTooLarge;
    }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return static::$navigationGroup ?? FilamentLogManager::get()->getNavigationGroup();
    }

    public static function getNavigationParentItem(): ?string
    {
        return static::$navigationParentItem ?? FilamentLogManager::get()->getNavigationParentItem();
    }

    public static function getActiveNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return static::$activeNavigationIcon ?? FilamentLogManager::get()->getActiveNavigationIcon();
    }

    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return static::$navigationIcon ?? FilamentLogManager::get()->getNavigationIcon();
    }

    public static function getNavigationLabel(): string
    {
        return static::$navigationLabel ?? FilamentLogManager::get()->getNavigationLabel();
    }

    public static function getNavigationBadge(): ?string
    {
        return FilamentLogManager::get()->getNavigationBadge();
    }

    public static function getNavigationBadgeColor(): string | array | null
    {
        return FilamentLogManager::get()->getNavigationBadgeColor();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return static::$navigationBadgeTooltip ?? FilamentLogManager::get()->getNavigationBadgeTooltip();
    }

    public static function getNavigationSort(): ?int
    {
        return static::$navigationSort ?? FilamentLogManager::get()->getNavigationSort();
    }

    public static function getSlug(?Panel $panel = null): string
    {
        return static::$slug ?? FilamentLogManager::get()->getSlug();
    }

    public function getTitle(): string
    {
        return static::$title ?? FilamentLogManager::get()->getTitle();
    }

    public static function canAccess(): bool
    {
        return FilamentLogManager::get()->canAccess();
    }

    public static function canDelete(): bool
    {
        return FilamentLogManager::get()->canDelete();
    }

    public static function canDownload(): bool
    {
        return FilamentLogManager::get()->canDownload();
    }
}
