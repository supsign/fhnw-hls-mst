<x-layout.app>
    <x-slot name="title">
        Planungen
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                <div class="flex flex-row justify-between">
                    <div class="my-auto">
                        @lang('l.plannings')
                    </div>
                    <a href="{{ route('mentor.planning.create', $mentorStudent->student) }}" class="">
                        <i class="fas fa-plus-circle text-blue-700 fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
                <div>
                    {{$mentorStudent->firstname}} {{$mentorStudent->lastname}}
                </div>
            </x-slot>

            <div class="flex flex-col mb-4">
                @foreach($plannings as $planning)
                    <a href="{{ route('mentor.planning.showOne', [$planning->student, $planning]) }}">
                        <x-planning.single-item :planning=$planning></x-planning.single-item>
                    </a>
                @endforeach
            </div>
        </x-app.card>
    </div>
</x-layout.app>
