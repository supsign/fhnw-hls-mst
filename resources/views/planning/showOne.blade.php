<x-layout.app>
    <x-slot name="title">
        Studienplanung
    </x-slot>

    <div class="container p-3 mx-auto ">
        <x-app.card>
            <x-slot name="title">
                <div class="flex flex-row justify-between">
                    <div class="my-auto">@lang('l.planning')</div>
                    <vue-form method="POST"
                              action="{{ $mentorStudent ? route('mentor.planning.delete', [$mentorStudent->student, $planning]) : route('planning.delete', $planning) }}">
                        @csrf
                        @method('DELETE')
                        <button class="" type="submit" name="delete_planning"><i
                                class="fas fa-trash text-red-600 text-xl" aria-hidden="true"></i></button>
                    </vue-form>
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

            <x-base.link href="{{ route('planning.print', $planning) }}"> Drucken</x-base.link>

        </x-app.card>
        <vue-form method="POST"
                  action="{{ $mentorStudent ? route('mentor.planning.setRecommendations', [$mentorStudent->student, $planning])  : route('planning.setRecommendations', $planning) }}">
            @csrf
            <button class="button-primary mb-4" type="submit">gem. Studienplan planen</button>
        </vue-form>
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
                    <div class="my-auto w-2/3 text-sm">
                        {{$courseGroupYear->courseGroup->name}}
                    </div>
                    <vue-course-group-state :course-group-year="{{$courseGroupYear}}"
                                            :courses="{{$courseGroupYear->getCourses()}}"
                                            :completions="{{$planning->student->completions}}"></vue-course-group-state>

                </template>
                @foreach($courseGroupYear->courseCourseGroupYears as $courseCourseGroupYear)
                    @inject('courseCompletionService', 'App\Services\Completion\CourseCompletionService')
                    <vue-course-detail
                        :course="{{$courseCourseGroupYear->course}}"
                        :course-year="{{$courseCourseGroupYear->course->getCourseYearBySemesterOrLatest() ?? json_encode(null)}}"
                        :planning-id="{{$planning->id}}"
                        :semesters="{{\App\Models\Semester::all()}}"
                        :required-skills="{{$courseCourseGroupYear->course->requiredSkills}}"
                        :skills="{{$planning->student->skills}}"
                        {{$courseCompletionService->courseIsSuccessfullyCompleted($courseCourseGroupYear->course, $planning->student) ?'course-isSuccessfully-completed' : ''}}
                    >
                        <template v-slot:icon>
                            <x-planning.completion :student="$planning->student"
                                                   :course="$courseCourseGroupYear->course"></x-planning.completion>
                        </template>
                    </vue-course-detail>
                @endforeach
            </vue-plan-wrapper>
        @endforeach
        <x-assessment.assessment-state :planning="$planning"></x-assessment.assessment-state>
    </div>
</x-layout.app>
