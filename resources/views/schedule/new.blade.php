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
                <div class="flex flex-col space-y-4 mt-4">
                    Hier folgt eine Form zum erstellen eines neuen Stundenplans.
                    <x-base.input type="text" name="class" label="Klasse" value="{{ old('class') }}" :init-errors="$errors->get('class')"/>
                    <x-base.button class="mt-4 button-primary w-36 justify-center" type="submit">@lang('l.save')</x-base.button>
                </div>
            </vue-form>
        </x-app.card>
    </div>
</x-layout.app>
