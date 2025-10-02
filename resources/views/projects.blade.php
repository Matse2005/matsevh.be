<x-layouts.app :title="__('Projecten')" header='Projecten'
    subtitle="Op deze pagina ontdek je projecten waaraan ik gewerkt heb, dit kan zelfstandig  zijn maar ook in teamverband.">
    <x-section>
        <div class="grid
    grid-cols-1 lg:grid-cols-2 gap-3">
            @foreach (App\Models\Project::orderByDesc('id')->get() as $project)
                <x-card class="space-y-4">
                    @if ($project->image)
                        <img src="{{ $project->image }}" alt="{{ $project->title }}"
                            class="w-full h-48 object-cover rounded-lg" />
                    @endif

                    <flux:heading level="3" size="lg">{{ $project->title }}</flux:heading>

                    @if ($project->description)
                        <flux:text>
                            {!! $project->description !!}
                        </flux:text>
                    @endif

                    {{-- Technologies / Tags --}}
                    {{-- @if ($project->technologies)
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach ($project->technologies as $tech)
                                <flux:button variant="filled" class="text-xs px-2 py-1">
                                    {{ trim($tech) }}
                                </flux:button>
                            @endforeach
                        </div>
                    @endif --}}

                    @if ($project->github_url || $project->demo_url)
                        <div class="flex justify-between gap-3 mt-3">
                            @if ($project->github_url)
                                <flux:button class="w-full" variant="primary" icon="github"
                                    href="{{ $project->github_url }}" target="_blank">
                                    GitHub
                                </flux:button>
                            @endif

                            @if ($project->demo_url)
                                <flux:button class="w-full" variant="primary" icon="arrow-top-right-on-square"
                                    href="{{ $project->demo_url }}" target="_blank">
                                    Bekijken
                                </flux:button>
                            @endif
                        </div>
                    @endif
                </x-card>
            @endforeach
        </div>
    </x-section>
</x-layouts.app>
