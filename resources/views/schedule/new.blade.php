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
                    <x-base.input type="text" name="course" label="Course" value="{{ old('course') }}" :init-errors="$errors->get('course')"/>
                    <x-base.checkbox name="check" :init-errors="$errors->get('check')">
                        Check
                    </x-base.checkbox>
                    <x-base.select clearable name="select" optionKey="name" label="select"></x-base.select>
                    <x-base.button class="mt-4 button-primary w-36 justify-center" type="submit">@lang('l.save')</x-base.button>
                </div>
            </vue-form>
        </x-app.card>
    </div>
</x-layout.app>
