<x-layouts.app :title="__('')" header='Hey, Ik ben <span class="text-accent-content">Matse Van Horebeek</span>!'
    :subtitle="App\Models\Profile::key('description')->value">
    <x-section header="Vind me op">
        <div class="flex flex-wrap gap-3">
            <flux:button href="https://github.com/matse2005" target="_blank" icon="github" variant="filled"
                data-umami-event="social-github">GitHub
            </flux:button>
            <flux:button href="https://linkedin.com/in/matsevh" target="_blank" icon="linkedin" variant="filled"
                data-umami-event="social-linkedin">LinkedIn
            </flux:button>
        </div>
    </x-section>
    <x-section header="Contacteer me">
        <x-slot name="subtitle">
            Je kan me altijd bereiken op:
            <flux:link href="mailto:matse@vanhorebeek.be" data-umami-event="mailto-matse@vanhorebeek.be">
                matse@vanhorebeek.be</flux:link>
        </x-slot>
    </x-section>
</x-layouts.app>
