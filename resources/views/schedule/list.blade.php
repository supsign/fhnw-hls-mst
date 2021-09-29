<x-layout.app>
    <x-slot name="title">
        @lang('l.scheduleCurrent')
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-user.me></x-user.me>

        <x-app.card>
            <x-slot name="title">
                @lang('l.scheduleCurrent')
            </x-slot>
            <div class="md:grid md:grid-cols-2 md:gap-x-6 md:gap-y-3">
                @for ($i = 1; $i < 5; $i++)
                    <div class="flex flex-col mb-4">
                        <div class="font-bold mb-2">
                            {{ $i }}. Semester
                        </div>
                        @foreach($modules as $module)
                            <div class="bg-gray-200 p-2 m-2 rounded">
                                {{ $module }}
                            </div>
                        @endforeach
                    </div>
                @endfor
            </div>
        </x-app.card>
    </div>
</x-layout.app>
