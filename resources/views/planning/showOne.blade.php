<x-layout.app>
    <x-slot name="title">
        Studienplanung
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                Studienplanung
            </x-slot>
            <div class="border-2 mt-4 p-4 rounded">
                <vue-form>
                    <div class="py-2 px-4 bg-red-500 rounded-md text-sm text-white float-right ml-2">
                        <span class="">Delete</span>
                    </div>
                    <div>{{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
                    <div>{{ $planning->studyFieldYear->studyField->name }}</div>
                    <div>@lang('l.startDate'): {{ $planning->studyFieldYear->beginSemester->year }}</div>
                </vue-form>
            </div>
        </x-app.card>

        @foreach($courseGroupYears as $courseGroupYear)
            <x-app.card>
                <x-slot name="title">
                    <div class="flex flex-row space-x-2">
                        <div class="my-auto">
                            <i class="fas fa-arrow-down" aria-hidden="true"></i>
                        </div>
                        <div class="my-auto">
                            {{$courseGroupYear->courseGroup->name}}
                        </div>
                    </div>
                </x-slot>
                <div class="text-sm lg:text-base">
                    @foreach($courseGroupYear->courseCourseGroupYears as $courseCourseGroupYear)
                        <div class="flex flex-row space-x-5 border-b p-1 text-left">
                            <div class="my-auto text-lg flex-none">
                                <i class="far fa-check-circle" aria-hidden="true"></i>
                            </div>
                            <div class="my-auto break-words flex-grow">
                                {{$courseCourseGroupYear->course->name}}
                            </div>
                            <div class="flex-none">
                                <vue-plan-course></vue-plan-course>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-app.card>
        @endforeach
    </div>
</x-layout.app>
