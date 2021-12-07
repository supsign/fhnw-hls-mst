<x-layout.app>
    <x-slot name="title">
        Aktueller Stand
    </x-slot>

    <div class="container p-3 mx-auto mt-4">
        <div class="sm:flex sm:space-x-4 mb-8 space-y-4 sm:space-y-0">
            <div class="w-full sm:w-[30rem]">
                <x-student.standing-info :student="$student"/>
            </div>
            <div class="w-full sm:flex-grow">
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
        @if($student->studyFieldYear)
            <div class="space-y-8 lg:flex lg:space-y-0 ">
                <div class="lg:w-3/4 lg:border-r lg:border-gray-300 lg:pr-4">
                    <div class="text-2xl text-gray-500 mb-4">Modulgruppen</div>
                    <div class="space-y-4 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-4">
                        @foreach($student->studyFieldYear->courseGroupYears()->with('courses')->get() as $courseGroupYear)
                            <x-student.standing-course-group :student="$student" :courseGroupYear="$courseGroupYear"/>
                        @endforeach
                    </div>
                </div>

                <div class="lg:pl-4">
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
        @endif()
    </div>
</x-layout.app>
