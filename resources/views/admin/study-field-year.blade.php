<x-layout.admin>
    <x-slot name="title">
        Studienrichtung - Start
    </x-slot>

    <vue-store-fill :model="'specialization'"
                    :entities="{{$studyFieldYear->studyField->specializations}}"></vue-store-fill>
    <vue-store-fill :model="'specializationYear'" :entities="{{$studyFieldYear->specializationYears}}"></vue-store-fill>
    <vue-store-fill :model="'courseSpecializationYear'"
                    :entities="{{$studyFieldYear->courseSpecializationYears}}"></vue-store-fill>
    <vue-store-fill :model="'crossQualification'"
                    :entities="{{$studyFieldYear->studyField->crossQualifications}}"></vue-store-fill>
    <vue-store-fill :model="'crossQualificationYear'"
                    :entities="{{$studyFieldYear->crossQualificationYears}}"></vue-store-fill>
    <vue-store-fill :model="'courseCrossQualificationYear'"
                    :entities="{{$studyFieldYear->courseCrossQualificationYears}}"></vue-store-fill>
    <vue-store-fill :model="'assessment'"
                    :entities="{{\App\Models\Assessment::all()}}"></vue-store-fill>
    <vue-store-fill :model="'recommendation'"
                    :entities="{{\App\Models\Recommendation::all()}}"></vue-store-fill>
    <vue-store-fill :model="'course'"
                    :entities="{{$studyFieldYear->courses}}"></vue-store-fill>

    <div class="space-y-6">
        <div class="text-2xl text-gray-500 mb-4">{{$studyFieldYear->studyField->name}}
            - {{$studyFieldYear->beginSemester->year}}</div>

        <x-app.card>
            <x-slot name="title">
                <div class="flex flex-row justify-between">
                    <div>
                        Modulgruppen
                    </div>
                    <a href="{{route('admin.studyFieldYears.courseGroups', [$studyFieldYear])}}">
                        <i class="far fa-edit" aria-hidden="true"></i>
                    </a>
                </div>
            </x-slot>

            @foreach($studyFieldYear->courseGroupYears as $courseGroupYear)
                <div>{{$courseGroupYear->courseGroup->name}}</div>
            @endforeach


        </x-app.card>

        <vue-admin-specialization-years
            :study-field-year="{{$studyFieldYear}}"
        ></vue-admin-specialization-years>

        <vue-admin-cross-qualification-years
            :study-field-year="{{$studyFieldYear}}"
        ></vue-admin-cross-qualification-years>

    </div>
</x-layout.admin>
