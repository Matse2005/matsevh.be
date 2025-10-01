<x-layouts.app.header :title="$title ?? null">
    <flux:main class="max-w-screen-md w-full mx-auto flex flex-col gap-7">
        <section>
            <flux:heading size="xl" level="1">
                {!! $header !!}
            </flux:heading>
            <flux:text>{!! $subtitle !!}</flux:text>
        </section>
        {{ $slot }}
    </flux:main>
</x-layouts.app.header>
