<x-layout.admin>
    <x-slot name="title">
        Querschnittqualifikation
    </x-slot>

    <div class="text-2xl text-gray-500 mb-4">Querschnittqualifikation</div>


    <x-app.card class="mb-4">
        <x-slot name="title">
            {{$crossQualificationYear->crossQualification->name}}
        </x-slot>


        <div>
            {{--            <div>--}}
            {{--                Studienrichtung: {{$crossQualificationYear->StudyFieldYear->StudyField->name}}--}}
            {{--            </div>--}}
            {{--            <div>--}}
            {{--                Start: {{$crossQualificationYear->StudyFieldYear->BeginSemester->year}}--}}
            {{--            </div>--}}
            {{--            <div>--}}
            {{--                Anzahl zum Bestehen: {{$crossQualificationYear->amount_to_pass}}--}}
            {{--            </div>--}}
        </div>


    </x-app.card>


    <x-app.card>
        <x-slot name="title">
            Module
        </x-slot>
        <vue-store-fill :model="'course'" :entities="{{$crossQualificationYear->courses}}"></vue-store-fill>
        <vue-admin-course-cross-qualification-year
            :init-course-cross-qualification-years="{{$crossQualificationYear->courseCrossQualificationYears}}"
            :cross-qualification-year="{{$crossQualificationYear}}"></vue-admin-course-cross-qualification-year>
    </x-app.card>


</x-layout.admin>
