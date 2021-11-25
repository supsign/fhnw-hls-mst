<x-layout.app>
    <x-slot name="title">
        @lang('l.landingPage')
    </x-slot>

    <div class="container p-3 mx-auto space-y-4 mt-2">
        <div class="sm:flex space-y-4 sm:space-y-0">
            <div class="sm:w-1/2 sm:pr-2">
                <x-user.userdata/>
            </div>
            @if($user->student)
                <div class="sm:w-1/2 sm:pl-2">
                    <x-student.mentors :student="$user->student"/>
                </div>
            @endif
        </div>

        @if($user->student)
            <x-user.my-planning/>
        @endif

        @if($user->mentor)
            <x-mentor.student-list :mentor="$user->mentor"></x-mentor.student-list>
        @endif
    </div>
</x-layout.app>
