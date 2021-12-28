<x-layout.admin>
    <x-slot name="title">
        Studienrichtung - Start
    </x-slot>

    <div class="space-y-4">
        <div class="text-2xl text-gray-500 mb-4">{{$studyFieldYear->studyField->name}}
            - {{$studyFieldYear->beginSemester->year}}</div>

        <vue-admin-specialization-year
            :specialization-years="{{$studyFieldYear->specializationYears}}"
            :specializations="{{$studyFieldYear->studyField->specializations}}"
        ></vue-admin-specialization-year>

        <x-app.card>
            <x-slot name="title">
                Modulgruppen
            </x-slot>

            @foreach($studyFieldYear->courseGroupYears as $courseGroupYear)
                <div>{{$courseGroupYear->courseGroup->name}}</div>
            @endforeach


        </x-app.card>

        <x-app.card>
            <x-slot name="title">
                Spezialisierungen
            </x-slot>

            @foreach($studyFieldYear->specializationYears as $specializationYear)
                <div>{{$specializationYear->specialization->name}}</div>
                <div>{{$specializationYear->recommendation?->name}}</div>
                <div>{{$specializationYear->assessment?->name}}</div>
            @endforeach


        </x-app.card>

        <x-app.card>
            <x-slot name="title">
                Querschnittqualifikationen
            </x-slot>

            @foreach($studyFieldYear->crossQualificationYears as $crossQualificationYear)
                <div>{{$crossQualificationYear->crossQualification->name}}</div>
            @endforeach


        </x-app.card>
    </div>
</x-layout.admin>
