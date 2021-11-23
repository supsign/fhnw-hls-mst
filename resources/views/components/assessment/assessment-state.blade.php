<vue-assessment-state :assessment="{{$assessment ?? json_encode(null)}}"
                      :assessment-courses="{{$assessmentCourses ?? json_encode(null)}}"
                      :completions="{{$planning->student->completions}}"
                      :planning-id="{{$planning->id}}"
                      :semesters="{{ $semesters }}"
></vue-assessment-state>
