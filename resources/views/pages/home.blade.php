<x-layout.app>
    <x-slot name="title">
        Startseite
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-user.userdata></x-user.userdata>
        <x-user.my-plannings></x-user.my-plannings>
    </div>
    <div class="fixed z-30 cursor-pointer right-5 bottom-14">
        <a href="{{ route('planning.create') }}" class="button-primary m-3 text-sm">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
    </div>
</x-layout.app>
