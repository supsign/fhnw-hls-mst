<x-layout.admin>
    <x-slot name="title">
        Assessment
    </x-slot>

    <vue-store-fill :model="'assessment'"
                    :entity="{{$assessment}}"></vue-store-fill>
    <vue-store-fill :model="'assessmentCourse'" :entities="{{$assessment->assessmentCourses}}"></vue-store-fill>
    <vue-store-fill :model="'course'" :entities="{{$assessment->courses}}"></vue-store-fill>

    <div class="space-y-4">
        <div class="text-2xl text-gray-500 mb-4"> Assessment
            - {{$assessment->name}}</div>

        <vue-admin-assessment :assessment-id="{{$assessment->id}}"></vue-admin-assessment>

    </div>
</x-layout.admin>
