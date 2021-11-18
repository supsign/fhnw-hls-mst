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
                        <button class="" type="submit" name="delete_planning"><i
                                class="fas fa-trash text-red-600 text-xl" aria-hidden="true"></i></button>
                    </vue-form>
                </div>
            </x-slot>
            <div class="mt-2">
                <div>{{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
                <div>{{ $planning->studyFieldYear->studyField->name }}</div>
                <div>@lang('l.startDate'): {{ $planning->studyFieldYear->beginSemester->year }}</div>
            </div>
        </x-app.card>
        <x-app.card>
            <x-slot name="title">
                <div class="my-auto">@lang('l.legend')</div>
            </x-slot>
            <div class="flex flex-col space-y-2">
                <div class="my-auto flex flex-row space-x-3">
                    <i class="far fa-check-circle my-auto" aria-hidden="true"></i>
                    <div class="my-auto">@lang('l.completionPassed')</div>
                </div>

                <div class="my-auto flex flex-row space-x-3">
                    <i class="far fa-times-circle my-auto" aria-hidden="true"></i>
                    <div class="my-auto">@lang('l.completionFailed')</div>
                </div>
                <div class="flex flex-row space-x-3">
                    <i class="far fa-circle my-auto" aria-hidden="true"></i>
                    <div class="my-auto">@lang('l.completionNone')</div>
                </div>
            </div>

        </x-app.card>
        <vue-store-fill model="coursePlanning" :entities="{{$planning->coursePlannings}}"></vue-store-fill>
        @foreach($courseGroupYears as $courseGroupYear)
            <vue-plan-wrapper>
                <template v-slot:header>


                    <div class="my-auto flex-grow">
                        {{$courseGroupYear->courseGroup->name}}

                    </div>
                    <vue-course-group-state :course-group-year="{{$courseGroupYear}}"
                                            :courses="{{$courseGroupYear->getCourses()}}"
                                            :completions="{{$planning->student->completions}}"></vue-course-group-state>

                </template>
                <div class="text-sm lg:text-base">
                    @foreach($courseGroupYear->courseCourseGroupYears as $courseCourseGroupYear)
                        <div class="flex flex-row space-x-5 border-b p-1 text-left">
                            <x-planning.completion :student="$user->student"
                                                   :course="$courseCourseGroupYear->course"></x-planning.completion>
                            <div class="my-auto break-words flex-grow">
                                {{$courseCourseGroupYear->course->name}}
                            </div>
                            <div class="flex-none my-auto">
                                @inject('semesterService', 'App\Services\Semester\SemesterService')
                                <vue-plan-course :planning-id="{{$planning->id}}"
                                                 :course-id="{{$courseCourseGroupYear->course->id}}"
                                                 :semesters="{{$semesterService->getCurrentAndFutureSemesters()->sortBy('start_date')->slice(0,10)->values()}}"></vue-plan-course>
                            </div>
                        </div>
                    @endforeach
                </div>
            </vue-plan-wrapper>
        @endforeach
    </div>
</x-layout.app>
