<x-app.card completed="{{$completed}}">
    <x-slot name="title">
        @if($completed)
            <i class="far fa-check-circle text-green-500 font-bold" aria-hidden="true"></i>
        @endif
        {{$courseGroupYear->courseGroup->name}}
    </x-slot>
    @foreach($courseGroupYear->courses as $course)
        <x-student.standing-course :student="$student" :course="$course"/>
    @endforeach

    <x-slot name="footer">
        <div class="flex justify-end">
            <div>Total: {{$reachedCredits}}/{{$courseGroupYear->credits_to_pass}}</div>
        </div>
    </x-slot>


</x-app.card>