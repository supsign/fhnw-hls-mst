<x-app.card>
    <x-slot name="title">
        Weitere abgeschlossene Module
    </x-slot>
    @foreach($completions as $completion)
        <vue-uncounted-completion-course
            :student="{{ $student }}"
            :completion="{{ $completion }}"
            :course-groups="{{ $student->studyFieldYear?->courseGroups }}"
        ></vue-uncounted-completion-course>
    @endforeach
</x-app.card>
