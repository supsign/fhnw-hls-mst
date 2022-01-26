<x-layout.admin>
    <x-slot name="title">
        Assessment
    </x-slot>

    <vue-store-fill :model="'assessment'"
                    :entity="{{$assessment}}"></vue-store-fill>
    <vue-store-fill :model="'assessmentCourse'" :entities="{{$assessment->assessmentCourses}}"></vue-store-fill>
    <vue-store-fill :model="'course'" :entities="{{$assessment->courses}}"></vue-store-fill>
    <vue-store-fill :model="'studyFieldYear'" :entities="{{$assessment->allStudyFieldYears}}"></vue-store-fill>
    <vue-store-fill :model="'semester'" :entities="{{\App\Models\Semester::all()}}"></vue-store-fill>
    <vue-store-fill :model="'studyField'"
                    :entities="{{$assessment->allStudyFieldYears->getStudyFields()}}"></vue-store-fill>
    <vue-store-fill :model="'courseGroupYear'"
                    :entities="{{$assessment->allStudyFieldYears->getCourseGroupYears()}}"></vue-store-fill>
    <vue-store-fill :model="'courseCourseGroupYear'"
                    :entities="{{$assessment->allStudyFieldYears->getCourseCourseGroupYears()}}"></vue-store-fill>


    <div class="space-y-4">
        <div class="text-2xl text-gray-500 mb-4"> Assessment
            - {{$assessment->name}}</div>

        <vue-admin-assessment :assessment-id="{{$assessment->id}}"
                              :study-field-years="{{$assessment->allStudyFieldYears}}"></vue-admin-assessment>

    </div>
</x-layout.admin>
