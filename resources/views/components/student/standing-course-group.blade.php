<x-app.card completed="{{ $completed }}">
    <x-slot name="title">
        @if($completed)
            <i class="far fa-check-circle text-green-500 font-bold" aria-hidden="true"></i>
        @endif
        {{ $courseGroupYear->courseGroup->name }}
    </x-slot>
    @foreach($courseGroupYear->courses as $course)
        <x-student.standing-course :student="$student" :course="$course"/>
    @endforeach

    @foreach ($completions AS $completion)
        <div class="mb-4">
            <div class="flex">
                <div class="w-8">
                    <x-planning.completion 
                        :student="$student"
                        :course="$completion->courseYear->course"
                    />
                </div>
                <div>
                    {{ $completion->courseYear->course->name }}
                </div>
                <div></div>
            </div>
        </div>
    @endforeach

    <x-slot name="footer">
        <div class="flex justify-end">
            <div>Total: {{ $reachedCredits }}/{{ $courseGroupYear->credits_to_pass }}</div>
        </div>
    </x-slot>


</x-app.card>