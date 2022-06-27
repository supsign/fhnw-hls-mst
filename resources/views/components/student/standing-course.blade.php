<div class="mb-4">
    <div class="flex gap-3">
        <div>
            <x-planning.completion :student="$student"
                                   :course="$course"/>
        </div>
        <div>
            {{$course->name}}
        </div>
        <div></div>
    </div>
    {{--    <div class="ml-12 text-xs text-gray-500">--}}
    {{--        <ul class="list-disc">--}}
    {{--            @foreach($skills as $skill)--}}
    {{--                <li>{{$skill->definition}}</li>--}}
    {{--            @endforeach--}}
    {{--        </ul>--}}
    {{--    </div>--}}
</div>
