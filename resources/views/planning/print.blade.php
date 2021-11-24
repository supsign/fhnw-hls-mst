<!DOCTYPE html>
<html>
    <head>
        <title>FHNW HLS MST</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>

    <body>
        <header>
            FHNW HLS MST
        </header>

        Studium: {{ $planning->studyFieldYear->studyField->studyProgram->name }}<br/>
        Studienrichtung: {{ $planning->studyFieldYear->studyField->name }}<br/>
        Spezialisierung: {{ $planning->specializationYear?->specialization->name }}<br/>
        Querschnittsqualifikation: {{ $planning->crossQualificationYear?->crossQualification->name }}<br/>
        Erreichte Punkte: {{ $planning->getObtainedCredits() }}<br/>
        Geplante Punkte: {{ $planning->getPlannedCredits() }}<br/>
        


        @foreach ($planning->coursePlanningSemester AS $semester) 
            {{ $semester->is_hs ? 'HS' : 'FS' }} {{ $semester->year }}<br/>

            @foreach ($planning->coursePlannings AS $coursePlanning)       
                @if($coursePlanning->semester_id !== $semester->id)
                    @continue;
                @endif

                {{ $coursePlanning->course->name }}<br/>

            @endforeach
        @endforeach

        <footer>
            Copyright © 2021 by Supsign GmbH 
        </footer>
    </body>
</html>