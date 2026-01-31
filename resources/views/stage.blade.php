<x-layouts.app :title="__('Stage Planning')" header='Stage Planning'
    subtitle="Hieronder kan je een pdf en een excel versie vinden van mijn stage planning, deze documenten kunnen worden geupdate door de periode van mijn stage heen.">
    <x-section>
        <div class="flex flex-wrap gap-3">
            @foreach (App\Models\Document::type('stage') as $document)
                <flux:button href="/storage/{{ $document->file_path }}" target="_blank" icon="arrow-down-tray"
                    variant="primary" class="flex items-center gap-2">
                    {{ $document->title }}
                </flux:button>
            @endforeach
        </div>
    </x-section>
</x-layouts.app>
