<x-layout.admin>
    <x-slot name="title">
        @lang('l.courseEdit')
    </x-slot>

    <x-app.card class="mb-4">
        <x-slot name="title">
            @lang('l.courseEdit')
        </x-slot>

        <div class="flex flex-row font-bold mb-2">
            <div class="w-60">@lang('l.courseNumber')</div>
            <div class="flex-grow">@lang('l.name')</div>
            <div class="w-16">@lang('l.hs')</div>
            <div class="w-16">@lang('l.fs')</div>
        </div>
        @foreach($courses as $course)
            <vue-admin-course-edit :course="{{ $course }}"></vue-admin-course-edit>
        @endforeach
    </x-app.card>
</x-layout.admin>
