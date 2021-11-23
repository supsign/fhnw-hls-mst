<x-app.card>
    <x-slot name="title">
        {{$courseGroupYear->courseGroup->name}}
    </x-slot>
    @foreach($courseGroupYear->courses as $course)
        <x-student.standing-course :student="$student" :course="$course"/>
    @endforeach
</x-app.card>