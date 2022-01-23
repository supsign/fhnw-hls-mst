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
                                    <div>Start im</div>
                                    <div>{{$studyFieldYear->beginSemester->year}}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </x-app.card>
        @endforeach
        <x-app.card>
            <x-slot name="title">
                Assessments
            </x-slot>
            <div class="space-y-2">
                @foreach($assessments as $assessment)
                    <div>
                        <a href="{{route('admin.assessments.showOne', [$assessment])}}"
                           class="text-blue-500"
                        >

                            <div>{{$assessment->name}}</div>

                        </a>
                    </div>
                @endforeach
            </div>
        </x-app.card>
        <x-app.card>
            <x-slot name="title">
                Musterstudienpläne
            </x-slot>
            <div class="space-y-2">
                @foreach($recommendations as $recommendation)
                    <div>
                        <a href="{{route('admin.recommendation.showOne', [$recommendation])}}"
                           class="text-blue-500"
                        >

                            <div>{{$recommendation->name}}</div>

                        </a>
                    </div>
                @endforeach
            </div>
        </x-app.card>
    </div>
</x-layout.admin>
