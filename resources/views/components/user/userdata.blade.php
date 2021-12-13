<x-app.card>
    <div class="divide-y">
        <div class="pb-2">
            <div>{{ $user->firstname }} {{ $user->lastname }}</div>
            <x-user.role :user="$user"></x-user.role>
        </div>

        <x-user.studentdata :student="$user->student"></x-user.studentdata>
    </div>
</x-app.card>

