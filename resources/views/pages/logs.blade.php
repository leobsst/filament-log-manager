<x-filament::page>
    <div
        x-load
        x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-log-manager-alpine', 'leobsst/filament-log-manager') }}"
        x-data="editor({
            maxLines: @js(config('filament-log-manager.max_lines')),
            minLines: @js(config('filament-log-manager.min_lines')),
            fontSize: @js(config('filament-log-manager.font_size'))
        })">
        <div class="flex items-center justify-between gap-6">
            <div class="flex items-center space-x-2 shrink-0">
                @if($this->canDelete())
                {{ $this->deleteAction }}
                @endif
                @if($this->canDownload())
                {{ $this->downloadAction }}
                @endif
            </div>
            <div class="w-full">
                {{ $this->form }}
            </div>
            <div class="flex items-center space-x-2 shrink-0">
                {{ $this->jumpToStartAction }}
                {{ $this->refreshAction }}
                {{ $this->jumpToEndAction }}
            </div>
        </div>

        <div class="mt-4 rounded-lg editor-ace" x-ref="editor" wire:ignore></div>
    </div>
</x-filament::page>