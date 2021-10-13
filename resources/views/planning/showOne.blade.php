<x-layout.app>
    <x-slot name="title">
        Studienplanung
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                <div class="flex flex-row justify-between">
                    <div class="my-auto">@lang('l.planning')</div>
                    <vue-form method="POST" action="{{ route('planning.delete', $planning) }}">
                        @csrf
                        @method('DELETE')
                        <button class="" type="submit" name="delete_planning"><i class="fas fa-trash text-red-600 text-xl" aria-hidden="true"></i></button>
                    </vue-form>
                </div>
            </x-slot>
            <div class="mt-2">
                <div>{{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
                <div>{{ $planning->studyFieldYear->studyField->name }}</div>
                <div>@lang('l.startDate'): {{ $planning->studyFieldYear->beginSemester->year }}</div>
            </div>
        </x-app.card>
        <vue-store-fill model="coursePlanning" :entities="{{$planning->coursePlannings}}"></vue-store-fill>
        @foreach($courseGroupYears as $courseGroupYear)
            <x-app.card>
                <x-slot name="title">
                    <div class="flex justify-between">
                        <div class="flex flex-row space-x-2">
                            <div class="my-auto">
                                <i class="fas fa-arrow-down" aria-hidden="true"></i>
                            </div>
                            <div class="my-auto">
                                {{$courseGroupYear->courseGroup->name}}
                            </div>
                        </div>
                        <vue-course-group-state :course-group-year="{{$courseGroupYear}}"
                                                :courses="{{$courseGroupYear->getCourses()}}"
                                                :completions="{{$planning->student->completions}}"></vue-course-group-state>
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
                            <div class="flex-none my-auto">
                                <vue-plan-course :planning-id="{{$planning->id}}"
                                                 :course-id="{{$courseCourseGroupYear->course->id}}"></vue-plan-course>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-app.card>
        @endforeach
    </div>
</x-layout.app>
