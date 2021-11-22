<x-layout.app>
    <x-slot name="title">
        @lang('l.standing')
    </x-slot>

    <div class="container p-3 mx-auto">
        {{--        <x-user.userdata></x-user.userdata>--}}
        {{--        <x-user.my-planning></x-user.my-planning>--}}

        <x-app.card>
            <!-- ToDo mehr Angaben zum Standartuser hinzufügen -->
            <div class="divide-y">
                <div class="pb-2 flex justify-between">
                    <div>@lang('l.standing'): {{$user->firstname}} {{$user->lastname}}</div>
                    <div>{{$now}}</div>
                </div>
                <div class="py-2 border-t">
                    <div>{{ $student->studyFieldYear->studyField->studyProgram->name ?? __("l.studyField") . ': -' }}</div>
                    <div>{{ $student->studyFieldYear->studyField->name ?? __("l.studyProgram") .  ': -' }}</div>
                    <div>{{ $student->studyFieldYear->beginSemester->year ?? __("l.term") .  ': -' }}</div>
                    <div>@lang('l.credits'): {{ $studentCredits ?? '-'}}</div>
                </div>
            </div>
        </x-app.card>

        @foreach($student->studyFieldYear->courseGroupYears as $courseGroupsYear)
            @dump($courseGroupsYear->c)

        @endforeach
        <x-app.card>


        </x-app.card>


    </div>
</x-layout.app>
