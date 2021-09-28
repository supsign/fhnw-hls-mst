<x-layout.app>
    <x-slot name="title">
        neuer Stundenplan
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                neuer Stundenplan
            </x-slot>
            <vue-form id="new_schedule" method="POST" action="{{ route('schedule.create') }}">
                @csrf
                <div class="space-y-8 mt-4">
                    Hier folgt eine Form zum erstellen eines neuen Stundenplans.
                </div>
            </vue-form>
        </x-app.card>
    </div>
</x-layout.app>
