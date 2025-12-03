<?php

use Livewire\Volt\Component;
use App\Services\Installs\InstallServiceManager;

new class extends Component {
    public ?string $installs_source = null;
    public ?string $installs_identifier = null;

    public ?int $installCount = 0;
    public bool $loading = true;

    public function mount(string $installs_source = null, string $installs_identifier = null)
    {
        $this->installs_source = $installs_source;
        $this->installs_identifier = $installs_identifier;
        $this->loadInstalls();
    }

    public function loadInstalls()
    {
        $this->loading = true;

        try {
            $service = InstallServiceManager::make($this->installs_source);
            $this->installCount = $service->installs($this->installs_identifier);
        } catch (\Throwable $e) {
            $this->installCount = null;
        }

        $this->loading = false;
    }
};
?>

<flux:badge color="emerald" wire:poll.500s="loadInstalls" class="flex gap-1">
    @if ($loading)
        <flux:icon.loading class="size-4" />
    @endif

    @unless ($loading)
        <flux:icon.arrow-down-tray class="size-4" /> {{ $installCount !== null ? $installCount : '-1' }}
    @endunless
</flux:badge>
