<x-layout.admin>
    <x-slot name="title">
        Admin - {{$mentor->lastname}}
    </x-slot>

    <div>
        <div class="text-2xl text-gray-500 mb-4">{{$mentor->firstname}} {{$mentor->lastname}}</div>
        <vue-admin-mentor-study-fields :study-fields="{{$studyFields}}"
                                       :mentor-study-fields="{{$mentor->mentorStudyFields}}"
                                       :mentor="{{$mentor}}"
        ></vue-admin-mentor-study-fields>
    </div>
</x-layout.admin>
