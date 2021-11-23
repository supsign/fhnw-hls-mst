<vue-assessment-wrapper :assessment="{{$assessment ?? json_encode(null)}}"
                        :assessment-courses="{{$assessmentCourses ?? json_encode(null)}}"
                        :completions="{{$planning->student->completions}}"
                        :planning-id="{{$planning->id}}"
                        :semesters="{{ $semesters }}"
                        :specialisation-year="{{$specialisationYear ?? json_encode(null)}}"
></vue-assessment-wrapper>
