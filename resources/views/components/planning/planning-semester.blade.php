<x-app.card>
    <x-slot name="title">
        @lang('l.termPlanned')
    </x-slot>

    <div>eingeplante Punkte: <strong>{{ $planning->getTotalCredits() }}</strong></div>
    @foreach ($semesters AS $semester)
        <div class="mb-4">
            <vue-planning-semester
                :semester="{{ $semester }}"
                :planning="{{ $planning }}"
            ></vue-planning-semester>
        </div>
    @endforeach
</x-app.card>
