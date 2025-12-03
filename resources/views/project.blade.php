<x-layouts.app :title="$project->title">

    <x-section>
        <div class="flex flex-col gap-5">
            <div class="flex justify-between gap-3">
                <flux:heading size="xl" level="1">
                    {!! $project->title !!}
                </flux:heading>
                <div class="flex items-center gap-2">
                    @if ($project->github_url)
                        <flux:button icon="github" href="{{ $project->github_url }}" target="_blank"
                            data-umami-event="Project Github" data-umami-event-project="{{ $project->title }}" />
                    @endif

                    <flux:button variant="primary" icon="arrow-top-right-on-square"
                        href="{{ route('project', ['project' => $project->id, 'slug' => \Illuminate\Support\Str::slug($project->title)]) }}">
                        Bekijken
                    </flux:button>
                </div>
            </div>
            <flux:subheading>{!! $project->short_description !!}</flux:subheading>
            @if ($project->technologies)
                <div class="flex flex-wrap gap-2">
                    @foreach ($project->technologies as $tech)
                        <flux:badge size="sm" class="px-3 py-1.5 font-medium">
                            {{ trim($tech) }}
                        </flux:badge>
                    @endforeach
                </div>
            @endif

            @if ($project->installs_source && $project->installs_identifier)
                <flux:callout icon="information-circle" color="green" class="flex items-center gap-2">
                    <flux:callout.text class="flex flex-wrap items-center gap-1">
                        <span class="font-bold">{{ $project->title }}</span> is tot nu toe al
                        <livewire:installcounter :installs_source="$project->installs_source" :installs_identifier="$project->installs_identifier" />
                        keer geïnstalleerd! 🎉
                    </flux:callout.text>
                </flux:callout>
            @endif
        </div>

        <svg class=" w-42 mt-3 h-6 text-accent-content" viewBox="0 0 300 12" preserveAspectRatio="none" fill="none">
            <path
                d="M 0 6 Q 7.5 0, 15 6 T 30 6 T 45 6 T 60 6 T 75 6 T 90 6 T 105 6 T 120 6 T 135 6 T 150 6 T 165 6 T 180 6 T 195 6 T 210 6 T 225 6 T 240 6 T 255 6 T 270 6 T 285 6 T 300 6"
                stroke="currentColor" stroke-width="2" />
        </svg>
    </x-section>

    @if ($project->image)
        <x-card class="p-3">
            <img src="/storage/{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-full object-cover" />
        </x-card>
    @endif

    <x-section class="space-y-6">
        @if ($project->description)
            <flux:text class="text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                <div class="prose prose-lg dark:prose-invert">
                    {!! $project->description !!}
                </div>
            </flux:text>
            </div>
        @endif
    </x-section>
</x-layouts.app>
