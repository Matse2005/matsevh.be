<x-card>
    <div class="flex max-sm:flex-col max-sm:justify-start max-sm:items-start justify-between items-center gap-3">
        <div>
            <flux:heading size="md">{{ $title }}</flux:heading>
            <flux:text class="flex gap-1 items-center">
                <flux:icon :name="$icon" class="size-5" /> {{ $location }}
            </flux:text>
        </div>
        <div>
            <flux:text>
                @php
                    $startDate = \Carbon\Carbon::parse($start)->format('M Y');
                    $endDate = $end ? \Carbon\Carbon::parse($end)->format('M Y') : null;
                @endphp

                {{ $startDate }}
                @if ($endDate && $startDate !== $endDate)
                    - {{ $endDate }}
                @elseif (!$endDate)
                    - Huidig
                @endif
            </flux:text>
        </div>
    </div>
    @if ($description)
        <div class="prose prose-zinc dark:prose-invert">
            <flux:text class="">
                {!! $description !!}
            </flux:text>
        </div>
    @endif
</x-card>
