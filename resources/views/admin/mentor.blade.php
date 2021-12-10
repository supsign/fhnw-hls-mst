<x-layout.admin>
    <x-slot name="title">
        Admin - {{$mentor->lastname}}
    </x-slot>

    <div class="space-y-4">
        <div class="text-2xl text-gray-500 mb-4">{{$mentor->firstname}} {{$mentor->lastname}}</div>
        <vue-admin-mentor-study-fields :study-fields="{{$studyFields}}"
                                       :mentor-study-fields="{{$mentor->mentorStudyFields}}"
                                       :mentor="{{$mentor}}"
        ></vue-admin-mentor-study-fields>

        <vue-admin-mentor-students
            :mentor="{{$mentor}}"
            :init-mentor-students="{{$mentor->mentorStudent}}"
        ></vue-admin-mentor-students>
    </div>
</x-layout.admin>
