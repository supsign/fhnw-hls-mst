<x-layout.admin>
    <x-slot name="title">
        @lang('l.courseEdit')
    </x-slot>

    <x-app.card class="mb-4">
        <x-slot name="title">
            @lang('l.courseEdit')
        </x-slot>

        <div class="flex flex-row font-bold mb-2">
            <div class="w-60">Modul-Nummer</div>
            <div class="flex-grow">Name</div>
            <div class="w-24">HS</div>
            <div class="w-24">FS</div>
        </div>
        @foreach($courses as $course)
            <vue-admin-course-edit :course="{{ $course }}"></vue-admin-course-edit>
        @endforeach
    </x-app.card>
</x-layout.admin>
