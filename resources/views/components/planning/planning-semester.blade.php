@foreach ($semesters AS $semester)
    <div class="mb-4">
        <vue-planning-semester
            :semester="{{ $semester }}"
            :planning="{{$planning}}"
            :completions="{{ $planning->student->completions }}"
            @if(!$mentorStudent && $planning->is_locked)
            planning-is-locked
            @endif
        ></vue-planning-semester>
    </div>
@endforeach
