# Changelog

All notable changes to `filament-log-manager` will be documented in this file.

## v1.0.2 - 2026-04-16

### What's Changed

#### Compatibility

- Added **Laravel 13** support (`illuminate/contracts ^13.0`)
- Added **Filament 5** support (`filament/filament ^5.0`)

#### Dev Dependencies

- Added `orchestra/testbench ^11.0` for Laravel 13 testing support
- Added `pestphp/pest ^5.0` for Laravel 13 testing support
- Added `pestphp/pest-plugin-arch ^5.0` for Laravel 13 testing support
- Added `pestphp/pest-plugin-laravel ^5.0` for Laravel 13 testing support

#### CI

- Added Filament version dimension (`^4.0` / `^5.0`) to the test matrix
- Added Laravel 13 to the test matrix (PHP 8.4 only)
- Excluded Filament 5 from Laravel 11 matrix combinations
- Added `pest` and `pest-plugin-laravel` version per Laravel version in the matrix

**Full Changelog**: https://github.com/leobsst/filament-log-manager/compare/v1.0.1...v1.0.2

## v1.0.1 - 2025-10-07

### Some adjustments

- Number of lines rendered in the editor from `100` to `45` by default
- UI layout changes
  - position of `Refresh`, `Jum to start` and `Jump to end` actions changed
  - color of `Refresh`, `Jum to start` and `Jump to end` actions changed from `gray` to `info (blue)` for better readability
  

**Full Changelog**: https://github.com/leobsst/filament-log-manager/compare/v1.0.0...v1.0.1

## 1.0.0 - 2025-10-06

Read Laravel logs from the Filament v4 admin panel.

Requirements
PHP 8.2 or higher
Laravel 11.x or 12.x
Filament 4.x

### What's Changed

* fix update changelog by @leobsst in https://github.com/leobsst/filament-log-manager/pull/1

### New Contributors

* @leobsst made their first contribution in https://github.com/leobsst/filament-log-manager/pull/1

**Full Changelog**: https://github.com/leobsst/filament-log-manager/commits/v1.0.0
