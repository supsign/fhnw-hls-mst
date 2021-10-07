<x-layout.app>
    <x-slot name="title">
        neuer Stundenplan
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                neue Studienplanung
            </x-slot>
            <vue-form id="new_planning" method="POST" action="{{ route('planning.store') }}">
                @csrf
                <div class="flex flex-col space-y-4">
{{--                    <x-base.input type="text" name="course" label="Course" value="{{ old('course') }}" :init-errors="$errors->get('course')"/>--}}
{{--                    <x-base.checkbox name="check" :init-errors="$errors->get('check')">--}}
{{--                        Check--}}
{{--                    </x-base.checkbox>--}}
                    <x-base.select
                        clearable
                        name="studyProgram"
                        :options="$studyPrograms"
                        optionKey="name"
                        label="Studiengang"
                        :value="$studyPrograms"
                        disabled>
                    </x-base.select>
                    <x-base.select
                        clearable
                        name="studyField"
                        :options="$studyFields"
                        optionKey="name"
                        label="Studienrichtung"
                        required>
                    </x-base.select>
                    <x-base.select
                        clearable
                        name="semester"
                        :options="$semesters"
                        optionKey="year"
                        label="Start"
                        required>
                    </x-base.select>
                    <x-base.button class="mt-4 button-primary w-36 justify-center" type="submit">Erstellen</x-base.button>
                </div>
            </vue-form>
            <div class="border-2 mt-4 p-4 rounded ">
                <div class="float-right md:float-none p-4 md:px-2">
                    <i class="far fa-lightbulb fa-4x" aria-hidden="true"></i>
                </div>
                <div class="text-justify">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                    ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                    dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
                    amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                    ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                    dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
                    amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                    ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                    dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit
                    amet.
                </div>
            </div>
        </x-app.card>
    </div>
</x-layout.app>
