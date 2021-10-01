<div>
    <x-app.card>
        <x-slot name="title">
            <x-base.link href="{{ route('schedule.index') }}">@lang('l.scheduleCurrent')</x-base.link>
        </x-slot>

        <div class="flex flex-col mb-4">
            <!-- ToDo Beispiel-Stundenpläne erstellen -->
            @for ($i = 1; $i < 6; $i++)
                <x-schedule.single-item></x-schedule.single-item>
            @endfor
            <div class="mt-2">
                <a href="" class="button-primary w-auto">@lang('l.schedulesAll')</a>
            </div>
        </div>
    </x-app.card>
</div>
