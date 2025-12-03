<x-layouts.app :title="__('Projecten')" header='Projecten'
    subtitle="Op deze pagina ontdek je projecten waaraan ik gewerkt heb, dit kan zelfstandig  zijn maar ook in teamverband.">
    <x-section>
        <div class="grid grid-cols-1 gap-5">
            @foreach (App\Models\Project::orderBy('id')->get()->sort(function ($a, $b) {
            $orderA = $a->order === 0 ? PHP_INT_MAX : $a->order;
            $orderB = $b->order === 0 ? PHP_INT_MAX : $b->order;

            if ($orderA === $orderB) {
                return $b->id <=> $a->id;
            }

            return $orderA <=> $orderB;
        }) as $project)
                <x-card class="grid grid-cols-2 lg:grid-cols-2 gap-5">
                    @if ($project->image)
                        <img src="/storage/{{ $project->image }}" alt="{{ $project->title }}"
                            class="w-full h-full object-cover rounded-lg" />
                    @endif

                    <div class="flex flex-col justify-between gap-3">
                        <div class="">
                            <flux:heading level="3" size="lg" class="flex items-center gap-2">
                                {{ $project->title }}
                                @if ($project->installs_source && $project->installs_identifier)
                                    <livewire:installcounter :installs_source="$project->installs_source" :installs_identifier="$project->installs_identifier" />
                                @endif
                            </flux:heading>

                            @if ($project->description)
                                <flux:text class="">
                                    {{ $project->short_description }}
                                </flux:text>
                            @endif
                        </div>

                        <div class="flex justify-between gap-3">
                            @if ($project->github_url)
                                <flux:button class="w-full" icon="github" href="{{ $project->github_url }}"
                                    target="_blank" data-umami-event="Project Github"
                                    data-umami-event-project="{{ $project->title }}">
                                    GitHub
                                </flux:button>
                            @endif

                            <flux:button class="w-full" variant="primary" icon="information-circle"
                                href="{{ route('project', ['project' => $project->id, 'slug' => \Illuminate\Support\Str::slug($project->title)]) }}">
                                Meer info
                            </flux:button>
                        </div>
                    </div>
                </x-card>
            @endforeach
        </div>
    </x-section>
</x-layouts.app>
