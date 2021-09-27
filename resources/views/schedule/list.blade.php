<x-layout.app>
    <x-slot name="title">
        Stundenplanung
    </x-slot>

    <div class="container bg-gray-200 p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                Stundenplanung
            </x-slot>
            @for ($i = 1; $i < 6; $i++)
                <x-schedule.single-item></x-schedule.single-item>
            @endfor
        </x-app.card>
    </div>
</x-layout.app>
