<x-app.card>
    <x-slot name="title">
        <div class="flex flex-row justify-between">
            <div class="my-auto">
                Student:innen
            </div>
        </div>
    </x-slot>

    <div class="flex flex-col mb-4">
        @foreach($mentorStudents  as $mentorStudent)
            <a href="{{ route('mentor.planning.list', $mentorStudent->student) }}">
                <div class="p-2 md:p-3 bg-gray-100 mb-3 rounded text-sm md:text-base">
                    <div>{{ $mentorStudent->firstname }} {{ $mentorStudent->lastname }}</div>
                </div>
            </a>
        @endforeach
    </div>
</x-app.card>
