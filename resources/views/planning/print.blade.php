<!DOCTYPE html>
<html>
    <head>
        <title>FHNW HLS MST</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>PDF | HLS MST</title>

        <script src="{{ asset('js/app.js') }}" defer></script>

        <link rel="alternate" hreflang="x-default" href="@php echo url()->full() @endphp"/>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="text-lg font-bold">
            FHNW HLS MST Planung
        </div>

        <div class="my-4 text-lg">
            <div>Vorname Nachname: {{ $firstname }} {{ $lastname }}</div>
            <div>Studium: {{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
            <div>Studienrichtung: {{ $planning->studyFieldYear->studyField->name }}</div>
            <div>Spezialisierung: {{ $planning->specializationYear?->specialization->name ?? 'keine'}}</div>
            <div>Querschnittsqualifikation: {{ $planning->crossQualificationYear?->crossQualification->name ?? 'keine'}}</div>
            <div>Erreichte Punkte: {{ $planning->getObtainedCredits() }}</div>
            <div>Geplante Punkte: {{ $planning->getPlannedCredits() }}</div>
            <div>Total: {{ $planning->getTotalCredits() }}</div>
        </div>
        <div class="text-lg">
            @foreach ($planning->coursePlanningSemester AS $semester)
                <div class="font-bold">{{ $semester->is_hs ? 'HS' : 'FS' }} {{ $semester->year }}</div>

                @foreach ($planning->coursePlannings AS $coursePlanning)
                    @if($coursePlanning->semester_id !== $semester->id)
                        @continue;
                    @endif

                    <div class="ml-5">{{ $coursePlanning->course->number_unformated }} {{ $coursePlanning->course->name}}: ECTS {{ $coursePlanning->course->credits }}</div>

                @endforeach
            @endforeach
        </div>

        <div class="fixed bottom-0">
            Copyright © 2021 by Supsign GmbH
        </div>
    </body>
</html>
