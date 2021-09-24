<x-layout.app>
    <x-slot name="title">
        Startseite
    </x-slot>

    <div class="container pt-16 mb-16">
            Hallo {{$firstname}} {{$lastname}}
            <a href="mailto:{{$email}}">
                {{$email}}
            </a>
    </div>
</x-layout.app>
