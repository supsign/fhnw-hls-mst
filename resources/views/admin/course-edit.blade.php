<x-layout.admin>
    <x-slot name="title">
        @lang('l.courseEdit')
    </x-slot>

    <x-app.card class="mb-4">
        <x-slot name="title">
            @lang('l.courseEdit')
        </x-slot>
            <vue-admin-course-content-edit :course="{{$course}}"/>
    </x-app.card>
</x-layout.admin>
