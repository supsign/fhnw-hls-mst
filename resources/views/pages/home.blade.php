<x-layout.app>
    <x-slot name="title">
        Startseite
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-user.me></x-user.me>
        <x-user.my-schedules></x-user.my-schedules>
        <div class="fixed z-30 cursor-pointer right-5 bottom-14">
            <a href="{{ route('schedule.new') }}" class="button-primary m-3 text-sm">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</x-layout.app>
