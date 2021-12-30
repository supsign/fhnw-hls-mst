<x-layout.admin>
    <x-slot name="title">
        Studienrichtung - Start
    </x-slot>

    <vue-store-fill :model="'specializationYear'" :entities="{{$studyFieldYear->specializationYears}}"></vue-store-fill>
    <vue-store-fill :model="'specialization'"
                    :entities="{{$studyFieldYear->studyField->specializations}}"></vue-store-fill>
    <vue-store-fill :model="'assessment'"
                    :entities="{{\App\Models\Assessment::all()}}"></vue-store-fill>
    <vue-store-fill :model="'courseSpecializationYear'"
                    :entities="{{$studyFieldYear->courseSpecializationYears}}"></vue-store-fill>
    <vue-store-fill :model="'course'"
                    :entities="{{$studyFieldYear->courses}}"></vue-store-fill>

    <div class="space-y-4">
        <div class="text-2xl text-gray-500 mb-4">{{$studyFieldYear->studyField->name}}
            - {{$studyFieldYear->beginSemester->year}}</div>

        <x-app.card>
            <x-slot name="title">
                Modulgruppen
            </x-slot>

            @foreach($studyFieldYear->courseGroupYears as $courseGroupYear)
                <div>{{$courseGroupYear->courseGroup->name}}</div>
            @endforeach


        </x-app.card>

        <vue-admin-specialization-years
            :study-field-year="{{$studyFieldYear}}"
        ></vue-admin-specialization-years>

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
