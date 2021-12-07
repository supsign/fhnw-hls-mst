<x-app.card>
    <x-slot name="title">
        @lang('l.termPlanned')
    </x-slot>

    <div class="sm:text-sm lg:text-base">eingeplante Punkte: <strong>{{ $planning->getTotalCredits() }}</strong></div>
</x-app.card>
@foreach ($semesters AS $semester)
    <div class="mb-4">
        <vue-planning-semester
            :semester="{{ $semester }}"
            :planning-id="{{ $planning->id }}"
            :completions="{{ $planning->student->completions }}"
            :courses="{{ $planning->courses }}"
        ></vue-planning-semester>
    </div>
@endforeach
