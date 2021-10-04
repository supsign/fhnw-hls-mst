<div>
    <x-app.card>
        <x-slot name="title">
            @lang('l.planning')
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
