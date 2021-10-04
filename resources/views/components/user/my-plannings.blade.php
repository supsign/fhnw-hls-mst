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
            @for ($i = 1; $i < 6; $i++)
                <x-planning.single-item></x-planning.single-item>
            @endfor
            <div class="mt-2">
                <a href="" class="button-primary w-auto">@lang('l.planningsAll')</a>
            </div>
        </div>
    </x-app.card>
</div>
