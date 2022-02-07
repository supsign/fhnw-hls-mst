<x-layout.app>
    <x-slot name="title">
        @lang('l.planning')
    </x-slot>
    <div class="container p-3 mx-auto">
        <div class="w-full sm:flex-grow">
            <x-app.card class="bg-yellow-400 mb-4">
                <div class="flex">
                    <div class="pr-4">
                        <i class="far fa-lightbulb fa-2x" aria-hidden="true"></i>
                    </div>
                    <div>
                        Bitte beachten Sie, dass die hier angezeigten Informationen nicht verbindlich sind und
                        keinen Ersatz für die offiziellen Dokumente darstellen.
                    </div>
                </div>
            </x-app.card>

        </div>
        <div class="md:flex md:justify-between md:space-x-4">
            <x-app.card class="mb-4 md:w-1/2">
                <x-slot name="title">
                    <div class="flex flex-row justify-between">
                        <div class="my-auto flex">
                            @if ($planning->name)
                                <div class="pl-2"> {{ $planning->name }}</div>
                            @else
                                <div>@lang('l.planning')</div>
                            @endif
                        </div>
                        <div class="space-x-4 flex">
                            <x-base.link
                                href="{{ $mentorStudent ? route('mentor.planning.create.copy', [$mentorStudent->student, $planning]) : route('planning.create.copy', $planning) }}">
                                <i class="fas fa-copy text-blue-600 text-xl" aria-hidden="true"></i>
                            </x-base.link>
                            <x-base.link
                                href="{{ $mentorStudent ? route('mentor.planning.print', [$mentorStudent->student, $planning]) : route('planning.print', $planning) }}"
                                target="_blank" rel="noopener noreferrer">
                                <i class="fas fa-file-pdf text-blue-600 text-xl" aria-hidden="true"></i>
                            </x-base.link>

                            @if (!(!$mentorStudent && $planning->is_locked))
                                <vue-form method="POST"
                                          action="{{ $mentorStudent ? route('mentor.planning.delete', [$mentorStudent->student, $planning]) : route('planning.delete', $planning) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="delete_planning">
                                        <i class="fas fa-trash text-red-600 text-xl" aria-hidden="true"></i>
                                    </button>
                                </vue-form>
                            @endif
                        </div>


                    </div>
                    @if ($mentorStudent)
                        <div>{{ $mentorStudent->firstname }} {{ $mentorStudent->lastname }}</div>
                    @endif
                </x-slot>

                <div class="my-2">
                    <div>
                        <div>{{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
                        <div>{{ $planning->studyFieldYear->studyField->name }}</div>
                        <div>{{ $planning->crossQualificationYear?->crossQualification->name }}</div>
                        <div>{{ $planning->specializationYear?->specialization->name }}</div>
                        <div>@lang('l.startDate'):
                            {{ $planning->studyFieldYear->beginSemester->year }}</div>
                    </div>
                    <div class="text-left text-sm text-gray-500 mt-5">@lang('l.lastChange'):
                        {{ $planning->updated_at->format('d.m.Y') }}</div>

                    @if ($planning->studyFieldYear->studyField->url_study_guide)
                        <x-base.link href="{{ $planning->studyFieldYear->studyField->url_study_guide }}"
                                     target="_blank" rel="noopener noreferrer" class="flex space-x-2 mt-1">
                            <i class="fas fa-external-link text-blue-600 my-auto" aria-hidden="true"></i>
                            <div>@lang('l.studyGuideLink')</div>
                        </x-base.link>
                    @endif

                    @if ($mentorStudent)
                        <vue-lock-planning :planning="{{ $planning }}"></vue-lock-planning>
                    @endif
                </div>
            </x-app.card>

            <x-app.card class="mb-4 md:w-1/2">
                <x-slot name="title">
                    <div class="my-auto">@lang('l.legend')</div>
                </x-slot>

                <div class="flex flex-col space-y-2 md:flex-row md:space-x-2">
                    <div class="flex flex-col space-y-2 flex-grow">
                        <div class="my-auto flex flex-row space-x-3">
                            <i class="far fa-check-circle my-auto w-8" aria-hidden="true"></i>
                            <div class="my-auto">@lang('l.completionPassed')</div>
                        </div>

                        <div class="my-auto flex flex-row space-x-3">
                            <i class="far fa-times-circle my-auto w-8" aria-hidden="true"></i>
                            <div class="my-auto">@lang('l.completionFailed')</div>
                        </div>
                        <div class="flex flex-row space-x-3">
                            <i class="far fa-circle my-auto w-8" aria-hidden="true"></i>
                            <div class="my-auto">@lang('l.completionNone')</div>
                        </div>
                        <div class="flex flex-row space-x-3">
                            <div class="my-auto w-8 line-through" aria-hidden="true">ab</div>
                            <div class="my-auto">findet aktuell nicht statt</div>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2 flex-grow">
                        <div class="flex flex-row space-x-3">
                            <i class="far fa-calendar-exclamation my-auto w-8" aria-hidden="true"></i>
                            <div class="my-auto">Musterstudienplan</div>
                        </div>
                        <div class="flex flex-row space-x-3">
                            <i class="fas fa-sitemap my-auto w-8" aria-hidden="true"></i>
                            <div class="my-auto">Assessment</div>
                        </div>
                        <div class="flex flex-row space-x-3">
                            <i class="fas fa-sparkles my-auto w-8" aria-hidden="true"></i>
                            <div class="my-auto">Spezialisierung / Querschnittqualifikation</div>
                        </div>
                    </div>
                </div>


            </x-app.card>
        </div>

        <vue-store-fill model="coursePlanning" :entities="{{ $planning->coursePlannings }}"></vue-store-fill>
        <vue-store-fill model="semester" :entities="{{ \App\Models\Semester::all() }}"></vue-store-fill>
        @php
            $courses = $planning->studyFieldYear->courses;
            $courseSkills = App\Models\CourseSkill::whereIn('course_id', $courses->pluck('id'))
                ->where(['is_acquisition' => true])
                ->get()
        @endphp
        <vue-store-fill model="course" :entities="{{ $courses }}"></vue-store-fill>
        <vue-store-fill model="skillStudent" :entities="{{ $planning->student->skillStudent }}"></vue-store-fill>
        <vue-store-fill model="courseSkill" :entities="{{ $courseSkills }}"></vue-store-fill>

        <div class="space-y-8 md:flex md:space-y-0">
            <div class="md:w-3/4 md:border-r md:border-gray-300 md:pr-4">
                <div class="flex flex-col-reverse md:flex-row md:justify-between">
                    <div class="text-xl lg:text-2xl text-gray-500 mb-4">Modulgruppen</div>
                    <div>
                        @if (!(!$mentorStudent && $planning->is_locked))
                            <vue-form method="POST"
                                      action="{{ $mentorStudent ? route('mentor.planning.setRecommendations', [$mentorStudent->student, $planning]) : route('planning.setRecommendations', $planning) }}">
                                @csrf
                                <button class="button-primary mb-4" type="submit">gem. Musterstudienplan planen</button>
                            </vue-form>
                        @endif
                    </div>
                </div>
                <div class="md:grid md:grid-cols-1 lg:grid-cols-2 lg:gap-4">
                    @foreach ($courseGroupYears as $courseGroupYear)
                        <div>
                            <vue-plan-wrapper>
                                <template v-slot:header>
                                    <div class="flex flex-row">
                                        <div class="my-auto flex-grow hyphens-auto text-sm pr-2">
                                            {{$courseGroupYear->courseGroup->name}}
                                        </div>
                                        <vue-course-group-state
                                            class="flex-grow-0 flex-shrink-0"
                                            :course-group-year="{{$courseGroupYear}}"
                                            :courses="{{$courseGroupYear->courses}}"
                                            :completions="{{$planning->student->completions}}">

                                        </vue-course-group-state>
                                    </div>
                                </template>

                                @foreach($courseGroupYear->courseCourseGroupYears()->with('course')->get()->sortBy('course.name') as $courseCourseGroupYear)
                                    @inject('courseCompletionService', 'App\Services\Completion\CourseCompletionService')
                                    @inject('recommendationService', 'App\Services\Recommendation\RecommendationService')
                                    @inject('specializationYearService', 'App\Services\SpecializationYear\SpecializationYearService')
                                    @inject('crossQualificationYearService', 'App\Services\CrossQualificationYear\crossQualificationYearService')
                                    @php
                                        $courseIsSuccessfullyCompleted = $courseCompletionService->courseIsSuccessfullyCompleted($courseCourseGroupYear->course, $planning->student)
                                    @endphp
                                    <vue-course-detail
                                        :course-id="{{$courseCourseGroupYear->course_id}}"
                                        :course-year="{{$courseCourseGroupYear->course->getCourseYearBySemesterOrLatest() ?? json_encode(null)}}"
                                        :planning-id="{{$planning->id}}"
                                        {{$recommendationService->courseIsRecommended($courseCourseGroupYear->course, $planning->courseRecommendations) ? 'course-is-recommended': ''}}
                                        {{$specializationYearService->courseIsInSpecializationYear($courseCourseGroupYear->course, $planning->courseSpecializationYears) ? 'course-is-spec-cross': ''}}
                                        {{$crossQualificationYearService->courseIsInCrossQualificationYear($courseCourseGroupYear->course, $planning->courseCrossQualificationYears) ? 'course-is-spec-cross': ''}}

                                        {{$courseIsSuccessfullyCompleted ?'course-is-successfully-completed' : ''}}
                                        @if(!$mentorStudent && $planning->is_locked)
                                        planning-is-locked
                                        @endif
                                    >
                                        <template v-slot:icon>
                                            <x-planning.completion
                                                :courseIsSuccessfullyCompleted="$courseIsSuccessfullyCompleted"
                                                :student="$planning->student"
                                                :course="$courseCourseGroupYear->course"></x-planning.completion>
                                        </template>
                                    </vue-course-detail>
                                @endforeach
                            </vue-plan-wrapper>
                        </div>
                    @endforeach
                    <div>
                        <x-planning.uncounted-completions :student="$planning->student"
                                                          :study-field-year="$planning->studyFieldYear"></x-planning.uncounted-completions>
                    </div>
                </div>
            </div>
            <div class="hidden md:block md:w-2/4 lg:w-1/4 md:pl-4">
                <div class="text-xl lg:text-2xl text-gray-500 mb-4">Semesterübersicht</div>
                <x-planning.planning-semester :planning="$planning" :mentorStudent="$mentorStudent"/>
            </div>
        </div>
        <x-assessment.assessment-state :planning="$planning"></x-assessment.assessment-state>
    </div>
</x-layout.app>
