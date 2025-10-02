<x-layouts.app :title="__('Contacteer me')" header='Get in touch'
    subtitle="Voor alles rond projecten, samenwerking of vragen, contacteer mij hier.">
    <section>
        <flux:text>
            Je kan me altijd bereiken op:
            <flux:link href="mailto:matse@vanhorebeek.be" data-umami-event="mailto-matse@vanhorebeek.be">
                matse@vanhorebeek.be
            </flux:link>
        </flux:text>
        <flux:text>
            Je me ook altijd een bericht sturen
            <flux:link target="_blank" href="https://linkedin.com/in/matsevh" data-umami-event="social-linkedin">
                op linkedin
            </flux:link>
        </flux:text>
    </section>
    <flux:text>
        Ik antwoord normaal redelijk snel op werkdagen!
    </flux:text>
</x-layouts.app>
