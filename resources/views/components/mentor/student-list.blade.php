<x-app.card>
    <x-slot name="title">
        <div class="flex flex-row justify-between">
            <div class="my-auto">
                @lang('l.students')
            </div>
        </div>
    </x-slot>

    @if($mentor->mentorStudent()->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-4 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 mb-4">
            @foreach($mentor->mentorStudent AS $mentorStudent)
                <a href="{{ route('mentor.planning.list', $mentorStudent->student) }}">
                    <div class="p-2 md:p-3 bg-gray-100 mb-3 rounded text-sm md:text-base">
                        <div>{{ $mentorStudent->firstname }} {{ $mentorStudent->lastname }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div>
            @lang('l.mentorNoStudents')
        </div>
    @endif
</x-app.card>
