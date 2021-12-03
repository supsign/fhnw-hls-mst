<x-layout.admin>
    <x-slot name="title">
        @lang('l.courseEdit')
    </x-slot>

    <x-app.card class="mb-4">
        <x-slot name="title">
            @lang('l.courseEdit')
        </x-slot>
        <div class="grid grid-cols-4">
            @foreach($courses as $course)
                <div>Test</div>
            @endforeach
        </div>
    </x-app.card>
</x-layout.admin>
