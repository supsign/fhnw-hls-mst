<div>
    <vue-show-and-select-mentors :all-mentors="{{$allMentors}}"
                                 :init-mentor-students="{{$mentorStudents}}"
                                 :study-field="{{$studyField ?? json_encode(null)}}"
                                 :student-id="{{$student->id}}"
    ></vue-show-and-select-mentors>
</div>
