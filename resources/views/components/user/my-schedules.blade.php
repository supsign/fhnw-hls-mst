<div>
    <x-app.card>
        <x-slot name="title">
            Stundenplanung
        </x-slot>

        <div class="flex flex-col">
            @for ($i = 1; $i < 6; $i++)
                <div class="p-2 bg-gray-100 mb-2 rounded">Stundenplan {{$i}}</div>
            @endfor
        </div>
    </x-app.card>
</div>
