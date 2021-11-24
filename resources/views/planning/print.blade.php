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

        @if ($planning->specializationYear)
            Spez: {{ $planning->specializationYear->specialization->name }}<br/>
        @endif

        

        <footer>
            Copyright © 2021 by Supsign GmbH 
        </footer>
    </body>
</html>