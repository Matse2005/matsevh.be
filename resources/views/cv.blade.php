<x-layouts.app :title="__('Mijn CV')" header='Mijn CV'
    subtitle="Over de jaren heen heb ik verschillende skills geleerd en ervaringen opgedaan. Op deze pagina kan je meer te weten komen over mijn skills, opleidingen die ik gedaan heb, cursussen die ik gevolgt heb en werk ervaring die ik heb.">
    {{-- <section class="grid grid-cols-1 sm:grid-cols-2">
        <div class="">
            <flux:heading size="lg">Talen</flux:heading>
            <flux:text>
                Inleidende tekst op basis van talen
            </flux:text>
            <ul class="list-disc list-inside">
                @foreach (json_decode(App\Models\Profile::key('languages')->value, true) as $key => $value)
                    <li>
                        <flux:text><span class="font-bold">{{ $key }}:<span> {{ $value }}</flux:text>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="">
            <flux:heading size="lg">Hobbies</flux:heading>
            <flux:text>
                Inleidende tekst op basis van hobbies
            </flux:text>
            <ul class="list-disc list-inside">
                @foreach (json_decode(App\Models\Profile::key('hobbies')->value, true) as $hobby)
                    <li>
                        <flux:text>{{ $hobby }}</flux:text>
                    </li>
                @endforeach
            </ul>
        </div>
    </section> --}}
    <x-section subtitle="Wil je meer info weten of een pdf versie van mijn CV bekijk deze dan hieronder.">
        <div class="flex flex-wrap gap-3">
            @foreach (App\Models\Document::type('cv') as $document)
                <flux:button href="{{ $document->file_path }}" target="_blank" icon="arrow-down-tray" variant="primary"
                    class="flex items-center gap-2">
                    {{ $document->title }}
                </flux:button>
            @endforeach
        </div>
    </x-section>
    <x-section header="Skills"
        subtitle="Inleidende tekst op basis van skills, ook zeggen dat in sommige skills al meer ervaring heb dan andere.">
        <div class="flex flex-wrap gap-3">
            @foreach (App\Models\Skills::all() as $skill)
                <flux:button variant="filled" class="flex items-center gap-2">
                    @if ($skill->logo)
                        <img class="size-6" src="{{ $skill->logo }}" />
                    @endif
                    {{ $skill->skill }}
                </flux:button>
            @endforeach
        </div>
    </x-section>
    <x-section header="Studies" subtitle="Een lijst van al men studies">
        <div class="flex flex-col gap-3">
            @foreach (App\Models\Study::all() as $study)
                <x-cv.item icon="academic-cap" :title="$study->degree" :location="$study->school" :description="$study->description" :start="$study->start"
                    :end="$study->end" />
            @endforeach
        </div>
    </x-section>
    <x-section header="Ervaring" subtitle="Een lijst van al men werkervaring">
        <div class="flex flex-col gap-3">
            @foreach (App\Models\Work::all() as $work)
                <x-cv.item icon="briefcase" :title="$work->role" :location="$work->company" :description="$work->description" :start="$work->start"
                    :end="$work->end" />
            @endforeach
        </div>
    </x-section>
    <x-section header="Cursussen" subtitle="Een lijst van al men cursussen">
        <div class="flex flex-col gap-3">
            @foreach (App\Models\Course::all() as $course)
                <x-cv.item icon="book-open" :title="$course->title" :location="$course->institution" :description="$course->description" :start="$course->start"
                    :end="$course->end" />
            @endforeach
        </div>
    </x-section>
</x-layouts.app>
