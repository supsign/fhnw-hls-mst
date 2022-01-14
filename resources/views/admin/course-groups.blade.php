<x-layout.admin>
    <x-slot name="title">
        Modulgruppen und Module
    </x-slot>

    <vue-store-fill :model="'courseGroupYears'"
                    :entities="{{$courseGroupYears}}"></vue-store-fill>
    <vue-store-fill :model="'courseCourseGroupYears'"
                    :entities="{{$courseCourseGroupYears}}"></vue-store-fill>
    <vue-store-fill :model="'course'"
                    :entities="{{$courses}}"></vue-store-fill>


</x-layout.admin>
