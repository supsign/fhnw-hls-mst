<x-app.card>
    <x-slot name="title">
        Weitere abgeschlossene Module
    </x-slot>
    @foreach($completions as $completion)
        <x-student.standing-course :student="$student" :course="$completion->courseYear->course"/>
    @endforeach


</x-app.card>
