<x-layout.admin>
    <x-slot name="title">
        Admin - Stgl
    </x-slot>

    <div>
        <div class="text-2xl text-gray-500 mb-4">Studiengangleitende / Administratoren</div>
        <div class="grid gap-4 grid-cols-3">
            @foreach($mentors as $mentor)
                <x-app.card>
                    <a href="{{route('admin.mentor', [$mentor])}}">
                        <div class="text-gray-600 pb-2">
                            {{$mentor->lastname}}
                            {{$mentor->firstname}}
                        </div>
                        <div class="mt-2">
                            @foreach($mentor->studyFields as $studyField)
                                <div>{{$studyField->name}}</div>
                            @endforeach
                        </div>
                    </a>

                </x-app.card>
            @endforeach
        </div>
    </div>
</x-layout.admin>
