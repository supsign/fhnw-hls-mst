<x-layout.admin>
    <x-slot name="title">
        Studienrichtungen
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        @foreach($studyFields as $studyField)
        <x-app.card>
            <x-slot name="title">
                {{$studyField->name}}
            </x-slot>
            <div class="space-y-2">
                @foreach($studyField->studyFieldYears as $studyFieldYear)
                    <div>
                        <a href="{{route('admin.studyFieldYears.show', [$studyFieldYear])}}"
                            class="text-blue-500"
                        >
                            <div class="flex flex-row">
                                <div>Start im </div>
                                <div>{{$studyFieldYear->beginSemester->year}}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </x-app.card>
        @endforeach
    </div>
</x-layout.admin>
