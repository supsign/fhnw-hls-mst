<x-layout.app>
    <x-slot name="title">
        Studienplanung
    </x-slot>

    <div class="container p-3 mx-auto ">
        <x-app.card class="mb-4">
            <x-slot name="title">
                <div class="flex flex-row justify-between">
                    <div class="my-auto">@lang('l.planning')</div>
                    <div class="space-x-4 flex">
                        <x-base.link href="{{ route('planning.print', $planning) }}">
                            <i
                                    class="fas fa-print text-blue-600 text-xl" aria-hidden="true"></i></x-base.link>

                        <vue-form method="POST"
                                  action="{{ $mentorStudent ? route('mentor.planning.delete', [$mentorStudent->student, $planning]) : route('planning.delete', $planning) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="delete_planning"><i
                                        class="fas fa-trash text-red-600 text-xl" aria-hidden="true"></i></button>
                        </vue-form>
                    </div>


                </div>
                @if($mentorStudent)
                    <div>{{ $mentorStudent->firstname }} {{ $mentorStudent->lastname }}</div>
                @endif
            </x-slot>
            <div class="mt-2">
                <div>{{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
                <div>{{ $planning->studyFieldYear->studyField->name }}</div>
                <div>{{ $planning->crossQualificationYear?->crossQualification->name }}</div>
                <div>{{ $planning->specializationYear?->specialization->name }}</div>
                <div>@lang('l.startDate'): {{ $planning->studyFieldYear->beginSemester->year }}</div>
            </div>


        </x-app.card>
        <div>
            <vue-form method="POST"
                      action="{{ $mentorStudent ? route('mentor.planning.setRecommendations', [$mentorStudent->student, $planning])  : route('planning.setRecommendations', $planning) }}">
                @csrf
                <button class="button-primary mb-4" type="submit">gem. Studienplan planen</button>
            </vue-form>
        </div>

        <x-app.card class="mb-4">
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
        <div class="lg:flex lg:flex-row lg:gap-4">
            <div class="lg:grid lg:grid-cols-2 lg:gap-4 lg:w-3/4">
                @foreach($courseGroupYears as $courseGroupYear)

                    <div>
                        <vue-plan-wrapper>
                            <template v-slot:header>
                                <div class="my-auto w-2/3 text-sm">
                                    {{$courseGroupYear->courseGroup->name}}
                                </div>
                                <vue-course-group-state :course-group-year="{{$courseGroupYear}}"
                                                        :courses="{{$courseGroupYear->getCourses()}}"
                                                        :completions="{{$planning->student->completions}}"></vue-course-group-state>

                            </template>
                            @foreach($courseGroupYear->courseCourseGroupYears as $courseCourseGroupYear)
                                <div class="flex border-t p-1 text-left text-xs lg:text-sm">
                                    <div class="w-8">
                                        <x-planning.completion :student="$planning->student"
                                                               :course="$courseCourseGroupYear->course"></x-planning.completion>
                                    </div>
                                    <div class="my-auto break-words flex-grow">
                                        {{$courseCourseGroupYear->course->name}}
                                    </div>
                                    <div class="flex-none my-auto">
                                        @inject('semesterService', 'App\Services\Semester\SemesterService')
                                        @inject('courseCompletionService', 'App\Services\Completion\CourseCompletionService')
                                        @if(!$courseCompletionService->courseIsSuccessfullyCompleted($courseCourseGroupYear->course, $planning->student))
                                            <vue-plan-course :planning-id="{{$planning->id}}"
                                                             :course="{{$courseCourseGroupYear->course}}"
                                                             :semesters="{{\App\Models\Semester::all()}}">
                                            </vue-plan-course>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </vue-plan-wrapper>
                    </div>
                @endforeach
            </div>
            <div class="lg:w-1/4">
                <x-planning.planning-semester :planning="$planning" />
            </div>
        </div>
        <x-assessment.assessment-state :planning="$planning"></x-assessment.assessment-state>
    </div>
</x-layout.app>
