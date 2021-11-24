<div>
    <x-app.card>
        <x-slot name="title">
            <div class="flex justify-between">
                <div>
                    @if($completed)
                        <i class="far fa-check-circle text-green-500 font-bold" aria-hidden="true"></i>
                    @endif
                    Spezialisierung {{$specializationYear->specialization->name}}
                </div>
            </div>
        </x-slot>
        <div class="flex flex-col">
            <div class="flex-grow">
                @foreach($specializationYear->courses as $course)
                    <x-student.standing-course-assessment :student="$student" :course="$course"/>
                @endforeach
            </div>

            <x-slot name="footer">
                <div class="flex justify-end">
                    <div>Total: {{$coursedPassed}}/{{$specializationYear->amount_to_pass}}</div>
                </div>
            </x-slot>

        </div>


        <div class="">


        </div>

    </x-app.card>


</div>