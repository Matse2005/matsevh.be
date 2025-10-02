<section class="space-y-3">
    @if (isset($header) || isset($subtitle))
        <div>
            @isset($header)
                <flux:heading level="2" size="lg">{{ $header }}</flux:heading>
            @endisset

            @isset($subtitle)
                <flux:text>
                    {{ $subtitle }}
                </flux:text>
            @endisset
        </div>
    @endif

    @if (trim($slot) !== '')
        <div>
            {{ $slot }}
        </div>
    @endif

</section>
