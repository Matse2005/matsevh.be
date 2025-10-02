@php
    $studies = App\Models\Study::all()->sort(function ($a, $b) {
        // Ongoing items first
        if (is_null($a->end) && !is_null($b->end)) {
            return -1;
        }
        if (!is_null($a->end) && is_null($b->end)) {
            return 1;
        }

        // Sort by start descending
        if ($a->start != $b->start) {
            return strtotime($b->start) - strtotime($a->start);
        }

        // Sort by end descending (nulls already handled)
        if ($a->end && $b->end) {
            return strtotime($b->end) - strtotime($a->end);
        }

        return 0;
    });

    $works = App\Models\Work::all()->sort(function ($a, $b) {
        if (is_null($a->end) && !is_null($b->end)) {
            return -1;
        }
        if (!is_null($a->end) && is_null($b->end)) {
            return 1;
        }
        if ($a->start != $b->start) {
            return strtotime($b->start) - strtotime($a->start);
        }
        if ($a->end && $b->end) {
            return strtotime($b->end) - strtotime($a->end);
        }
        return 0;
    });

    $courses = App\Models\Course::all()->sort(function ($a, $b) {
        if (is_null($a->end) && !is_null($b->end)) {
            return -1;
        }
        if (!is_null($a->end) && is_null($b->end)) {
            return 1;
        }
        if ($a->start != $b->start) {
            return strtotime($b->start) - strtotime($a->start);
        }
        if ($a->end && $b->end) {
            return strtotime($b->end) - strtotime($a->end);
        }
        return 0;
    });
@endphp

<x-layouts.app :title="__('Mijn CV')" header='Mijn CV'
    subtitle="In de loop der jaren heb ik verschillende skills geleerd en ervaring opgedaan. Op deze pagina kan je meer lezen over mijn vaardigheden, opleidingen, cursussen en werkervaring.">
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
                <flux:button href="/storage/{{ $document->file_path }}" target="_blank" icon="arrow-down-tray"
                    variant="primary" class="flex items-center gap-2">
                    {{ $document->title }}
                </flux:button>
            @endforeach
        </div>
    </x-section>
    <x-section header="Skills"
        subtitle="Hieronder vind je een lijst van enkele van mijn skills, van hard- tot softskills. Er kunnen technologieën ontbreken waar ik ervaring mee heb, dus bij vragen kan je me altijd contacteren.">
        <div class="flex flex-wrap gap-3">
            @foreach (App\Models\Skills::all() as $skill)
                <flux:button variant="filled" class="flex items-center gap-2">
                    @if ($skill->logo)
                        <img class="max-h-6 w-6" src="/storage/{{ $skill->logo }}" alt="{{ $skill->name }}">
                    @endif
                    {{ $skill->skill }}
                </flux:button>
            @endforeach
        </div>
    </x-section>
    <x-section header="Studies">
        <div class="flex flex-col gap-3">
            @foreach ($studies as $study)
                <x-cv.item icon="academic-cap" :title="$study->degree" :location="$study->school" :description="$study->description" :start="$study->start"
                    :end="$study->end" />
            @endforeach
        </div>
    </x-section>
    <x-section header="Ervaring">
        <div class="flex flex-col gap-3">
            @foreach ($works as $work)
                <x-cv.item icon="briefcase" :title="$work->role" :location="$work->company" :description="$work->description" :start="$work->start"
                    :end="$work->end" />
            @endforeach
        </div>
    </x-section>
    <x-section header="Cursussen">
        <div class="flex flex-col gap-3">
            @foreach ($courses as $course)
                <x-cv.item icon="book-open" :title="$course->title" :location="$course->institution" :description="$course->description" :start="$course->start"
                    :end="$course->end" />
            @endforeach
        </div>
    </x-section>
</x-layouts.app>
