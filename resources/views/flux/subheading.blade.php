@pure

@props([
    'size' => 'base',
])

@php
    $classes = Flux::classes()
        ->add(
            match ($size) {
                'xl' => 'text-2xl',
                'lg' => 'text-xl',
                default => 'text-lg',
                'sm' => 'text-base',
            },
        )
        ->add('[:where(&)]:text-zinc-500 [:where(&)]:dark:text-white/70');
@endphp

<div {{ $attributes->class($classes) }} data-flux-subheading>
    {{ $slot }}
</div>
