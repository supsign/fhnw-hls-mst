<div>
    <vue-show-and-select-mentors :all-mentors="{{$allMentors}}"
                                 :init-my-mentors="{{$myMentors}}"
                                 :study-field="{{$studyField ?? json_encode(null)}}"
    ></vue-show-and-select-mentors>
</div>
