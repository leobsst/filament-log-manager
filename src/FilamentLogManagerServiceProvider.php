<?php

namespace Leobsst\FilamentLogManager;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentLogManagerServiceProvider extends PackageServiceProvider
{
    public static string $packageName = 'filament-log-manager';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$packageName)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command->publishConfigFile();
            })
            ->hasConfigFile(static::$packageName)
            ->hasViews(static::$packageName)
            ->hasTranslations();
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        FilamentAsset::register($this->getAssets(), $this->getAssetPackageName());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'leobsst/' . static::$packageName;
    }

    protected function getAssets(): array
    {
        return [
            AlpineComponent::make((static::$packageName . '-alpine'), __DIR__ . '/../resources/dist/filament-log-manager.js'),
        ];
    }
}
