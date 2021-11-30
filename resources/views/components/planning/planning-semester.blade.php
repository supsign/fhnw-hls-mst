<x-app.card>
    <x-slot name="title">
        <div class="flex flex-row justify-between">
            <div class="my-auto">
                @lang('l.semesters')
            </div>
            <a href="{{ route('planning.create') }}" class="">
                <i class="fas fa-plus-circle text-blue-700 fa-2x" aria-hidden="true"></i>
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-4 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 mb-4">

        @foreach ($planning->coursePlanningSemester->unique() AS $semester)
            <div class="mb-4">
                <div class="font-bold">{{ $semester->is_hs ? 'HS' : 'FS' }} {{ $semester->year }}</div>

                @foreach ($planning->coursePlannings AS $coursePlanning)
                    @if($coursePlanning->semester_id !== $semester->id)
                        @continue;
                    @endif
                    <div class="ml-5 text-sm">{{ $coursePlanning->course->number_unformated }} {{ $coursePlanning->course->name}}: ECTS {{ $coursePlanning->course->credits }}</div>
                @endforeach
            </div>
        @endforeach
    </div>
</x-app.card>

