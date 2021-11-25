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

        <div class="grid grid-cols-1 sm:grid-cols-2 sm:gap-4 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 mb-4">
            {{--            ToDo Beispiel-Stundenpläne erstellen --}}
            @foreach($plannings as $planning)
                <a href="{{ route('planning.showOne', $planning) }}">
                    <x-planning.single-item :planning=$planning></x-planning.single-item>
                </a>
            @endforeach
        </div>
    </x-app.card>
</div>
