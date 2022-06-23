<x-layout.admin>
    <x-slot name="title">
        Studienrichtungen
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        @foreach($studyFields as $studyField)
            <x-app.card>
                <x-slot name="title">
                    {{ $studyField->name }}
                </x-slot>
                <div class="space-y-4">
                    <div class="space-y-2">
                        @foreach($studyField->studyFieldYears->sortBy('beginSemester.year') as $studyFieldYear)
                            <div class="ml-2">
                                <a href="{{route('admin.studyFieldYears.show', [$studyFieldYear])}}"
                                   class="text-blue-500"
                                >
                                    <div>Start im {{ $studyFieldYear->beginSemester->year }}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="space-y-2">
                        <div class="text-gray-400 text-sm">
                            Assessments
                        </div>
                        @foreach($studyField->assessments as $assessment)
                            <div class="ml-2">
                                <a href="{{route('admin.assessments.showOne', [$assessment])}}"
                                   class="text-blue-500"
                                >
                                    <div>{{ $assessment->name }}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="space-y-2">
                        <div class="text-gray-400 text-sm">
                            Recommendations
                        </div>
                        @foreach($studyField->recommendations as $recommendation)
                            <div class="ml-2">
                                <a href="{{route('admin.recommendation.showOne', [$recommendation])}}"
                                   class="text-blue-500"
                                >

                                    <div>{{ $recommendation->name }}</div>

                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </x-app.card>
        @endforeach
    </div>
</x-layout.admin>
