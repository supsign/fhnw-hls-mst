<x-layout.app>
    <x-slot name="title">
        @lang('l.landingPage')
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-user.userdata></x-user.userdata>
        @if($user->student)
            <x-student.mentors :student="$user->student"></x-student.mentors>
            <x-user.my-planning></x-user.my-planning>
        @endif

        @if($user->mentor)
            <x-mentor.student-list :mentor="$user->mentor"></x-mentor.student-list>
        @endif
    </div>
</x-layout.app>
