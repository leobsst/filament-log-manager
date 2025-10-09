# Filament log manager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/leobsst/filament-log-manager.svg?style=flat-square)](https://packagist.org/packages/leobsst/filament-log-manager)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/leobsst/filament-log-manager/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/leobsst/filament-log-manager/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/leobsst/filament-log-manager.svg?style=flat-square)](https://packagist.org/packages/leobsst/filament-log-manager)

Read Laravel logs from the Filament v4 admin panel.

# Features

- Syntax highlighting
- Light/Dark mode
- Quickly jump between start and end of the file
- Refresh log contents
- Delete log files
- Search multiple files in multiple directories
- Ignored file patterns

# Available languages

- 🇬🇧 English
- 🇫🇷 French
- 🇪🇸 Spanish

<br>

## Installation

### Requirements

- PHP 8.2 or higher
- Laravel 11.x or 12.x
- Filament 4.x
- Pest 3.x for testing (dev dependency)

You can install the package via composer:

```bash
composer require leobsst/filament-log-manager
```

<br>

> [!IMPORTANT]
> If you have not set up a custom theme and are using Filament Panels follow the instructions in the [Filament Docs](https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme) first.

After setting up a custom theme add the plugin's views to your theme css file or your app's css file if using the standalone packages.

```css
/* PLUGIN STYLE */
@import '../../../../vendor/leobsst/filament-log-manager/resources/css/index.css';

/* COMPILE TAILWINDCSS DIRECTIVES IN VIEWS */
@source '../../../../vendor/leobsst/filament-log-manager/resources/views/**/*.blade.php';
```

## Usage

Add the `Leobsst\FilamentLogManager\FilamentLogManager` to your panel config.

```php
use Leobsst\FilamentLogManager\FilamentLogManager;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ...
            ->plugin(
                FilamentLogManager::make()
            );
    }
}
```

## Configuration

### Customizing the navigation

```php
FilamentLogManager::make()
    ->navigationGroup('System')
    ->navigationParentItem('Tools')
    ->navigationLabel('Logs')
    ->navigationIcon('heroicon-o-server')
    ->activeNavigationIcon('heroicon-s-server')
    ->navigationBadge('+10')
    ->navigationBadgeColor('danger')
    ->navigationBadgeTooltip('New logs available')
    ->navigationSort(1)
    ->title('Application Logs')
    ->slug('logs')
```

### Customizing the log search

```php
FilamentLogManager::make()
  ->logDirs([
      storage_path('logs'), // The default value
  ])
  ->excludedFilesPatterns([
      '*2025*'
  ])
```

### Authorization
If you would like to prevent certain users from accessing the logs page, you should add a `authorize` callback in the FilamentLogManager chain.

```php
FilamentLogManager::make()
  ->authorize(
      fn () => auth()->user()->hasRole('admin')
  )
```

You can also prevent certain users from performing certain actions.

```php
FilamentLogManager::make()
  ->canDeleteUsing(
      fn () => auth()->user()->hasRole('admin')
  )
```

```php
FilamentLogManager::make()
  ->canDownloadUsing(
      fn () => auth()->user()->hasRole('support')
  )
```

### Customizing the log page

To customize the log page, you can extend the `Leobsst\FilamentLogManager\Pages\Logs` page and override its methods.
    
```php
use Leobsst\FilamentLogManager\Pages\Logs as BaseLogs;

class Logs extends BaseLogs
{
    // Your implementation
}
```

```php
use App\Filament\Pages\Logs;

FilamentLogManager::make()
  ->viewLog(Logs::class)
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-log-manager-config"
```

This is the contents of the published config file:

```php
return [
    //=======================================
    // LOG EDITOR INTERFACE
    //=======================================
    /**
     * Maximum amount of lines that editor will render.
     */
    'max_lines' => 45,

    /**
     * Minimum amount of lines that editor will render.
     */
    'min_lines' => 10,

    /**
     * Editor font size.
     */
    'font_size' => 12,

    //=======================================
    // FILE MANAGEMENT
    //=======================================
    /**
     * Set max file size reader
     * Default 5242880 = 5 MB
     */
    'max_file_size' => 5242880,

    //=======================================
    // PAGE FORM
    //=======================================
    /**
     * Limit the number of results returned from the search.
     * If set to -1 or null or 0 there is no limit.
     */
    'limit' => -1,
];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [LEOBSST](https://github.com/leobsst)
- [B.L.A.M. PRODUCTION](https://linksly.fr/BLAM-PRODUCTION)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
