<x-layout.admin>
    <x-slot name="title">
        Musterstudienplan
    </x-slot>

    <vue-store-fill :model="'recommendation'"
                    :entity="{{$recommendation}}"></vue-store-fill>
    <vue-store-fill :model="'courseRecommendation'"
                    :entities="{{$recommendation->courseRecommendations}}"></vue-store-fill>
    <vue-store-fill :model="'course'" :entities="{{$recommendation->courses}}"></vue-store-fill>
    <vue-store-fill :model="'studyFieldYear'" :entities="{{$recommendation->allStudyFieldYears}}"></vue-store-fill>
    <vue-store-fill :model="'semester'" :entities="{{\App\Models\Semester::all()}}"></vue-store-fill>
    <vue-store-fill :model="'studyField'"
                    :entities="{{$recommendation->allStudyFieldYears->getStudyFields()}}"></vue-store-fill>
    <vue-store-fill :model="'courseGroupYear'"
                    :entities="{{$recommendation->allStudyFieldYears->getCourseGroupYears()}}"></vue-store-fill>
    <vue-store-fill :model="'courseCourseGroupYear'"
                    :entities="{{$recommendation->allStudyFieldYears->getCourseCourseGroupYears()}}"></vue-store-fill>

    <div class="space-y-4">
        <div class="text-2xl text-gray-500 mb-4"> Musterstudienplan
            - {{$recommendation->name}}</div>

        <vue-admin-recommendation :recommendation-id="{{$recommendation->id}}"
                                  :study-field-years="{{$recommendation->allStudyFieldYears}}"></vue-admin-recommendation>

    </div>
</x-layout.admin>
