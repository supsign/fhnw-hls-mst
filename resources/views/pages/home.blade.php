<x-layout.app>
    <x-slot name="title">
        Startseite
    </x-slot>

    <div class="container bg-gray-200 p-3 mx-auto">
        <x-user.me></x-user.me>
        <x-user.my-schedules></x-user.my-schedules>
        <div class="flex justify-end">
            <a href="{{ route('schedule.new') }}" class="button-primary w-auto items-end m-3">+</a>
        </div>
    </div>
</x-layout.app>
