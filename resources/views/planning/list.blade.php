<x-layout.app>
    <x-slot name="title">
        Studienplanung
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                Studienplanung
            </x-slot>
            <div class="border-2 mt-4 p-4 rounded text-lg">
                <vue-form>
                    <div class="py-2 px-4 bg-red-500 rounded-md text-sm text-white float-right">
                        <span class="">Delete</span>
                    </div>
                    <div>{{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
                    <div>{{ $planning->studyFieldYear->studyField->name }}</div>
                    <div>@lang('l.startDate'): {{ $planning->studyFieldYear->beginSemester->year }}</div>
                </vue-form>
            </div>
        </x-app.card>
    </div>
</x-layout.app>
