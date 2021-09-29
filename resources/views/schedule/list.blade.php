<x-layout.app>
    <x-slot name="title">
        @lang('l.scheduleCurrent')
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-user.me></x-user.me>

        <x-user.current-schedule :modules="{{$modules}}"></x-user.current-schedule>
    </div>
</x-layout.app>
