<x-layout.app>
    <x-slot name="title">
        @lang('l.landingPage')
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-user.userdata></x-user.userdata>
        <x-user.my-plannings></x-user.my-plannings>
    </div>
</x-layout.app>
