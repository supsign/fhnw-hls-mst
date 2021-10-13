<div>
    <x-app.card>
        <x-slot name="title">
            <div class="flex flex-row justify-between">
                <div class="my-auto">
                    @lang('l.plannings')
                </div>
                <a href="{{ route('planning.create') }}" class="">
                    <i class="fas fa-plus-circle text-blue-700 fa-2x" aria-hidden="true"></i>
                </a>
            </div>
        </x-slot>

        <div class="flex flex-col mb-4">
            {{--            ToDo Beispiel-Stundenpläne erstellen --}}
            @foreach($plannings as $planning)
                <a href="{{ route('planning.showOne', $planning) }}">
                    <x-planning.single-item :planning=$planning></x-planning.single-item>
                </a>
            @endforeach
        </div>
    </x-app.card>
</div>
