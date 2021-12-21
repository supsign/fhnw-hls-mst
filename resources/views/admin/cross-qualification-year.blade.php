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
            <div>
                Studienrichtung: {{$crossQualificationYear->StudyFieldYear->StudyField->name}}
            </div>
            <div>
                Start: {{$crossQualificationYear->StudyFieldYear->BeginSemester->year}}
            </div>
            <div>
                Anzahl zum Bestehen: {{$crossQualificationYear->amount_to_pass}}
            </div>
        </div>


    </x-app.card>


    <x-app.card>
        <x-slot name="title">
            Module
        </x-slot>

        <vue-admin-course-cross-qualification-year :init-courses="{{$crossQualificationYear->courses}}"
                                                   :cross-qualification-year="{{$crossQualificationYear}}"></vue-admin-course-cross-qualification-year>
    </x-app.card>


</x-layout.admin>
