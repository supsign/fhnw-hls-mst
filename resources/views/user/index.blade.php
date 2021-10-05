<x-layout.app>
    <x-slot name="title">
        About me
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                User Data
            </x-slot>
            <div>
                <div>User-Number: {{ $user->student_id }}</div>
            </div>
        </x-app.card>
    </div>
</x-layout.app>
