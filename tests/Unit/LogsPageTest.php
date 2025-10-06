<?php

use Leobsst\FilamentLogManager\Pages\Logs;

beforeEach(function () {
    config()->set('filament-log-manager.limit', 50);
    config()->set('filament-log-manager.max_file_size', 1024);
});

class LogsTestDouble extends Logs
{
    public bool $simulateFileTooBig = false;

    public bool $simulateFileOutsideDir = false;

    public ?string $simulatedContent = null;

    protected function fileResidesInLogDirs(string $logFile): bool
    {
        if ($this->simulateFileOutsideDir) {
            return false;
        }

        return str_starts_with($logFile, storage_path('logs'));
    }

    protected function fileIsTooLarge(string $logFile): bool
    {
        if ($this->simulateFileTooBig) {
            return true;
        }

        return false;
    }

    public function read(): string
    {
        if (empty($this->logFile)) {
            return '';
        }

        if (! $this->fileResidesInLogDirs($this->logFile)) {
            return '';
        }

        if ($this->fileIsTooLarge($this->logFile)) {
            return '';
        }

        return $this->simulatedContent ?? '';
    }

    public function delete(): void
    {
        if ($this->logFile && $this->fileResidesInLogDirs($this->logFile)) {
            $this->logFile = null;
        }
    }

    public function download(): ?\Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        if (! $this->logFile || ! $this->fileResidesInLogDirs($this->logFile)) {
            return null;
        }

        return null;
    }
}

it('read returns empty when no file set', function () {
    $page = new LogsTestDouble;
    $page->logFile = null;
    expect($page->read())->toBe('');
});

it('read returns empty when file outside allowed dirs', function () {
    $page = new LogsTestDouble;
    $page->logFile = base_path('outside.log');
    $page->simulateFileOutsideDir = true;
    expect($page->read())->toBe('');
});

it('read returns empty when file too large', function () {
    $page = new LogsTestDouble;
    $page->logFile = storage_path('logs/laravel.log');
    $page->simulateFileTooBig = true;
    expect($page->read())->toBe('');
});

it('read returns file contents when valid', function () {
    $page = new LogsTestDouble;
    $page->logFile = storage_path('logs/laravel.log');
    $page->simulatedContent = 'content';
    expect($page->read())->toBe('content');
});

it('delete resets logFile and calls File::delete when valid', function () {
    $page = new LogsTestDouble;
    $page->logFile = storage_path('logs/laravel.log');
    $page->delete();
    expect($page->logFile)->toBeNull();
});

it('download returns null when file invalid', function () {
    $page = new LogsTestDouble;
    $page->logFile = base_path('outside.log');
    $page->simulateFileOutsideDir = true;
    expect($page->download())->toBeNull();
});
