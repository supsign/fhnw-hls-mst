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
        <vue-store-fill model="coursePlanning" :entities="{{$planning->coursePlannings}}"></vue-store-fill>
        @foreach($courseGroupYears as $courseGroupYear)
            <x-app.card>
                <x-slot name="title">
                    {{$courseGroupYear->courseGroup->name}}
                </x-slot>
                @foreach($courseGroupYear->courseCourseGroupYears as $courseCourseGroupYear)
                    <div class="flex flex-row justify-between">
                        <div class="text-sm">
                            {{$courseCourseGroupYear->course->name}}
                            {{$courseCourseGroupYear->course->id}}
                        </div>
                        <vue-plan-course :course-id="{{$courseCourseGroupYear->course->id}}" :planning-id="{{$planning->id}}"></vue-plan-course>
                    </div>
                @endforeach
            </x-app.card>
        @endforeach
    </div>
</x-layout.app>
