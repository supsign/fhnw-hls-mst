<x-layout.app>
    <x-slot name="title">
        neue Planung
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                Studienplanung erstellen
            </x-slot>
            <vue-form
                id="new_planning"
                method="POST"
                action="{{ $mentorStudent ? route('mentor.planning.store', $mentorStudent->student) : (!empty($planning) ? route('planning.store.copy', $planning) : route('planning.store')) }}"
            >
                @csrf
                <div class="flex flex-col space-y-8">
                    <vue-create-planning-form
                        :study-programs="{{ $studyPrograms }}"
                        :study-fields="{{ $studyFields }}"
                        :study-field-years="{{ $studyFieldYears }}"
                        :semesters="{{ $semesters }}"
                        :student="{{ $student ?? json_encode(null) }}"
                        :specializations="{{ $specializations }}"
                        :specialization-years="{{$specializationYears}}"
                        :cross-qualifications="{{ $crossQualifications }}"
                        :cross-qualification-years="{{ $crossQualificationYears }}"
                    ></vue-create-planning-form>
                    <x-base.button class="mt-4 button-primary w-36 justify-center" type="submit">Erstellen
                    </x-base.button>
                </div>
            </vue-form>
        </x-app.card>
    </div>
</x-layout.app>
