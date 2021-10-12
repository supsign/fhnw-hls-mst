<div>
    <x-app.card>
        <x-slot name="title">
            <div class="my-auto">
                @lang('l.planning')
            </div>
            <a href="{{ route('planning.create') }}" class="">
                <i class="fas fa-plus-circle text-blue-700 fa-2x" aria-hidden="true"></i>
            </a>
        </x-slot>

        <div class="flex flex-col mb-4">
            {{--            ToDo Beispiel-Stundenpläne erstellen --}}
            @foreach($plannings as $planning)
                <a href="{{ route('planning.showOne', $planning) }}">
                    <x-planning.single-item :planning=$planning></x-planning.single-item>
                </a>
            @endforeach
            <div class="mt-4 flex md:flex-none text-center">
                <a href="" class="button-primary md:w-auto">@lang('l.planningsAll')</a>
            </div>
        </div>
    </x-app.card>
</div>
