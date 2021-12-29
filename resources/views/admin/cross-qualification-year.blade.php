<x-layout.admin>
    <x-slot name="title">
        Querschnittqualifikation
    </x-slot>
    <vue-store-fill :model="'course'" :entities="{{$crossQualificationYear->courses}}"></vue-store-fill>

    <div class="text-2xl text-gray-500 mb-4">Querschnittqualifikation</div>

    <div class="space-y-4">
        <vue-admin-cross-qualification-year
            :semester="{{$crossQualificationYear->studyFieldYear->beginSemester}}"
            :init-cross-qualification-year="{{$crossQualificationYear}}"
            :cross-qualification="{{$crossQualificationYear->crossQualification}}"
            :study-field="{{$crossQualificationYear->studyFieldYear->studyField}}"
        >
        </vue-admin-cross-qualification-year>


        <vue-admin-course-cross-qualification-year
            :init-course-cross-qualification-years="{{$crossQualificationYear->courseCrossQualificationYears}}"
            :cross-qualification-year="{{$crossQualificationYear}}"
        ></vue-admin-course-cross-qualification-year>
    </div>


</x-layout.admin>
