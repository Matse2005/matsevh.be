<x-layouts.app.header :title="$title ?? null">
    <flux:main class="max-w-screen-md w-full mx-auto flex flex-col gap-9">
        @if (isset($header) || isset($subtitle))
            <section>
                @isset($header)
                    <flux:heading size="xl" level="1">
                        {!! $header !!}
                    </flux:heading>
                @endisset
                @isset($subtitle)
                    <flux:subheading>{!! $subtitle !!}</flux:subheading>
                @endisset
                <svg class=" w-42 mt-3 h-6 text-accent-content" viewBox="0 0 300 12" preserveAspectRatio="none"
                    fill="none">
                    <path
                        d="M 0 6 Q 7.5 0, 15 6 T 30 6 T 45 6 T 60 6 T 75 6 T 90 6 T 105 6 T 120 6 T 135 6 T 150 6 T 165 6 T 180 6 T 195 6 T 210 6 T 225 6 T 240 6 T 255 6 T 270 6 T 285 6 T 300 6"
                        stroke="currentColor" stroke-width="2" />
                </svg>
            </section>
        @endif
        {{ $slot }}
    </flux:main>
</x-layouts.app.header>
