<div>
    <x-app.card>
        <x-slot name="title">
            Stundenplanung
        </x-slot>

        <div class="flex flex-col">
            @for ($i = 1; $i < 6; $i++)
                <div class="">Stundenplan {{$i}}</div>
            @endfor
        </div>
    </x-app.card>
</div>
