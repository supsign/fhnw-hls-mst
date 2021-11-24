<div>
    <x-app.card>
        <x-slot name="title">
            <div class="flex justify-between">
                <div>
                    Assessment {{$student->studyFieldYear->assessment->name}}
                </div>
            </div>
        </x-slot>
        <div class="flex flex-col">
            <div class="flex-grow">
                @foreach($student->studyFieldYear->assessment->courses as $course)
                    <x-student.standing-course-assessment :student="$student" :course="$course"/>
                @endforeach
            </div>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <div>Total: $/{{$student->studyFieldYear->assessment->amount_to_pass}}</div>
                </div>
            </x-slot>

        </div>


        <div class="">


        </div>

    </x-app.card>


</div>