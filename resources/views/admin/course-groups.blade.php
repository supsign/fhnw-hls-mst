<x-layout.admin>
    <x-slot name="title">
        Modulgruppen und Module
    </x-slot>

    <div class="text-2xl text-gray-500">Module in Modulgruppen</div>
    <div class="text-lg text-gray-500 mb-4">{{$studyFieldYear->studyField->name}}
        - {{$studyFieldYear->beginSemester->year}}</div>

    <vue-store-fill :model="'courseGroupYear'"
                    :entities="{{$courseGroupYears}}"></vue-store-fill>
    <vue-store-fill :model="'courseGroup'"
                    :entities="{{$courseGroups}}"></vue-store-fill>
    <vue-store-fill :model="'courseCourseGroupYear'"
                    :entities="{{$courseCourseGroupYears}}"></vue-store-fill>
    <vue-store-fill :model="'course'"
                    :entities="{{$courses}}"></vue-store-fill>

    <vue-admin-course-groups :study-field-year="{{$studyFieldYear}}"></vue-admin-course-groups>
</x-layout.admin>
