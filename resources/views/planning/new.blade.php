<x-layout.app>
    <x-slot name="title">
        neuer Stundenplan
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                neuer Stundenplan
            </x-slot>
            <vue-form id="new_planning" method="POST" action="{{ route('planning.create') }}">
                @csrf
                <div class="flex flex-col space-y-4">
{{--                    <x-base.input type="text" name="course" label="Course" value="{{ old('course') }}" :init-errors="$errors->get('course')"/>--}}
{{--                    <x-base.checkbox name="check" :init-errors="$errors->get('check')">--}}
{{--                        Check--}}
{{--                    </x-base.checkbox>--}}
                    <x-base.select
                        clearable
                        name="select_stuff"
                        :options="$roles"
                        optionKey="name"
                        label="select stuff">
                    </x-base.select>
                    <x-base.select
                        clearable
                        name="select_stuff2"
                        :options="$roles"
                        optionKey="name"
                        label="select stuff">
                    </x-base.select>
                    <x-base.button class="mt-4 button-primary w-36 justify-center" type="submit">@lang('l.save')</x-base.button>
                </div>
            </vue-form>
            <div class="border-2 mt-4 p-4 rounded md:flex md:flex-row md:space-x-4">
                <i class="far fa-lightbulb fa-4x" aria-hidden="true"></i>
                <div class="mt-4">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                    ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                    dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
                    amet.
                </div>
            </div>
        </x-app.card>
    </div>
</x-layout.app>
