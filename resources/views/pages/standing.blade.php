<x-layout.app>
    <x-slot name="title">
        Aktueller Stand
    </x-slot>

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
                            Bitte beachten Sie, dass die hier angezeigten Informationen nicht verbindlich sind und keinen Ersatz des offiziellen Transcript of Records (TOR) darstellen.
                        </div>
                    </div>
                </x-app.card>

            </div>
        </div>
        <div class="flex">
            <div class="w-3/4 border-r border-gray-300 pr-4">
                <div class="text-2xl text-gray-500 mb-4">Modulgruppen</div>
                <div class="grid grid-cols-3 gap-4">
                    @foreach($student->studyFieldYear->courseGroupYears()->with('courses')->get() as $courseGroupYear)
                        <x-student.standing-course-group :student="$student" :courseGroupYear="$courseGroupYear"/>
                    @endforeach
                </div>
            </div>

            <div class="pl-4">
                <div class="mb-8">
                    <div class="text-2xl text-gray-500 mb-4">Assessment</div>
                    <x-student.standing-assessment :student="$student"/>
                </div>
                <div class="space-y-4 mb-8">
                    <div class="text-2xl text-gray-500 mb-4">Spezialisierungen</div>
                    @if($student->studyFieldYear->specializationYears()->count())
                        @foreach($student->studyFieldYear->specializationYears()->with('courses')->get() as $specializationYear)
                            <x-student.standing-specialization :student="$student" :specializationYear="$specializationYear"/>
                        @endforeach
                    @endif
                </div>

                <div>
                    <div class="text-2xl text-gray-500 mb-4">Querschnittsqualifikation</div>
                    @if($student->studyFieldYear->crossQualificationYears()->count())
                        @foreach ($student->studyFieldYear->crossQualificationYears()->with('courses')->get() as $crossQualificationYear)
                            <x-student.standing-crossqualification :student="$student" :crossQualificationYear="$crossQualificationYear"/>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
