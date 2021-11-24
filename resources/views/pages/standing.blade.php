<x-layout.app>
    <x-slot name="title">
        Aktueller Stand
    </x-slot>

    {{$student->skills->count()}}

    @foreach($student->skills as $skill)
    @endforeach

    <div class="container p-3 mx-auto mt-4">
        <div class="flex space-x-4">
            <div class="w-[30rem]">
                <x-student.standing-info :student="$student"/>
            </div>
            <div class="flex-grow">
                <x-app.card class="bg-yellow-400">
                    <div class="flex">
                        <div class="pr-4">
                            <i class="far fa-lightbulb fa-2x" aria-hidden="true"></i>
                        </div>
                        <div>
                            Bitte beachten Sie, dass die hier angezeigten Informationen nicht verbindlich sind und Ersatz des offiziellen Transcript of Records (TOR) darstellen.
                        </div>
                    </div>
                </x-app.card>

            </div>
        </div>
        <div class="flex">
            <div class="w-1/2 border-r border-gray-300 pr-4">
                <div class="text-2xl text-gray-500 mb-4">Modulgruppen</div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($student->studyFieldYear->courseGroupYears as $courseGroupYear)
                        <x-student.standing-course-group :student="$student" :courseGroupYear="$courseGroupYear"/>
                    @endforeach
                </div>
            </div>

            <div class="pl-4 pr-4 w-1/4 border-r border-gray-300">
                <div class="mb-8">
                    <div class="text-2xl text-gray-500 mb-4">Assessment</div>
                    <x-student.standing-assessment :student="$student"/>
                </div>
                <div class="space-y-4">
                    <div class="text-2xl text-gray-500 mb-4">Spezialisierungen</div>
                    @if($student->studyFieldYear->specializationYears)
                        @foreach($student->studyFieldYear->specializationYears as $specializationYear)
                            <x-student.standing-specialization :student="$student" :specializationYear="$specializationYear"/>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="pl-4">
                <div>
                    <div class="text-2xl text-gray-500 mb-4">Querschnittsqualifikation</div>
                    @if($student->studyFieldYear->crossQualificationYears)
                        @foreach ($student->studyFieldYear->crossQualificationYears as $crossQualificationYear)
                            <x-student.standing-crossqualification :student="$student" :crossQualificationYear="$crossQualificationYear"/>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
