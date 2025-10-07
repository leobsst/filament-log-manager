<x-filament::page>
    <div
        x-load
        x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-log-manager-alpine', 'leobsst/filament-log-manager') }}"
        x-data="editor({maxLines: @js(config('filament-log-manager.max_lines')), minLines: @js(config('filament-log-manager.min_lines')), fontSize: @js(config('filament-log-manager.font_size'))})">
        <!-- LOG FILE FORM -->
        <div class="flex items-center justify-between gap-4">
            @if($this->canDelete())
            <div>
                {{ $this->deleteAction }}
            </div>
            @endif
            <div class="w-full">
                {{ $this->form }}
            </div>
            @if($this->canDownload())
            <div>
                {{ $this->downloadAction }}
            </div>
            @endif
        </div>
        <!-- EDITOR -->
        <div class="relative">
            <!-- LOGS -->
            <div class="mt-4 rounded-lg editor-ace" x-ref="editor" wire:ignore></div>
            <!-- ACTIONS -->
            <div class="absolute right-5 top-2 flex items-center space-x-2 shrink-0 opacity-60">
                {{ $this->jumpToStartAction }}
                {{ $this->refreshAction }}
                {{ $this->jumpToEndAction }}
            </div>
        </div>
    </div>
</x-filament::page>