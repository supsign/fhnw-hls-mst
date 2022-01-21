<!DOCTYPE html>
<html>

<head>
    <title>FHNW HLS MST</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>PDF | HLS MST</title>

    <link rel="alternate" hreflang="x-default" href="@php echo url()->full() @endphp" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="text-lg font-bold">
        @if ($planning->name)
            {{ $planning->name }}
        @else
            FHNW HLS MST Planung
        @endif
    </div>

    <div class="my-2 pb-2 text-sm" style="border-bottom:1px solid black">
        <div>Vorname Nachname: {{ $firstname ?? '' }} {{ $lastname ?? '' }}</div>
        <div>Studium: {{ $planning->studyFieldYear->studyField->studyProgram->name }}</div>
        <div>Studienrichtung: {{ $planning->studyFieldYear->studyField->name }}</div>
        <div>Spezialisierung: {{ $planning->specializationYear?->specialization->name ?? 'keine' }}</div>
        <div>Querschnittsqualifikation: {{ $planning->crossQualificationYear?->crossQualification->name ?? 'keine' }}
        </div>
        <div>Erreichte Punkte: {{ $planning->getObtainedCredits() }}</div>
        <div>Geplante Punkte: {{ $planning->getPlannedCredits() }}</div>
        <div>Total: {{ $planning->getTotalCredits() }}</div>
    </div>
    <div class="">
        @foreach ($planning->coursePlanningSemester as $semester)
            <div class="mb-4">
                <div class="font-bold">{{ $semester->is_hs ? 'HS' : 'FS' }} {{ $semester->year }}</div>

                @foreach ($planning->coursePlannings as $coursePlanning)
                    @if ($coursePlanning->semester_id !== $semester->id)
                        @continue;
                    @endif
                    <div class="ml-5 text-sm">{{ $coursePlanning->course->number_unformated }}
                        {{ $coursePlanning->course->name }}: ECTS {{ $coursePlanning->course->credits }}</div>
                @endforeach
            </div>
        @endforeach
    </div>

</body>

</html>
