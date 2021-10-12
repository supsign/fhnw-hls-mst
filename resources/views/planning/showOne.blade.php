<x-layout.app>
    <x-slot name="title">
        Studienplanung
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                Studienplanung
            </x-slot>
            <div class="mt-2">
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
        <vue-store-fill model="coursePlanning" :entities="{{$planning->coursePlannings}}"></vue-store-fill>
        @foreach($courseGroupYears as $courseGroupYear)
            <vue-plan-wrapper>
                <template v-slot:header>

                    
                    <div class="my-auto">
                        {{$courseGroupYear->courseGroup->name}}
                    </div>
                    <vue-course-group-state :course-group-year="{{$courseGroupYear}}"
                                            :courses="{{$courseGroupYear->getCourses()}}"
                                            :completions="{{$planning->student->completions}}"></vue-course-group-state>

                </template>
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
            </vue-plan-wrapper>
        @endforeach
    </div>
</x-layout.app>
