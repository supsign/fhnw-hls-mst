<x-app.card>
    <div class="divide-y">
        <div class="pb-2">
            <div>{{ $user->firstname }} {{ $user->lastname }}</div>
            <x-user.role :user="$user"></x-user.role>

            @if($user->can('show backend'))
                <div class="mb-2 mt-4 mt-4 text-center flex md:flex-none">
                    <a class="button-primary md:w-auto" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
            @endif
        </div>

        <x-user.studentdata :student="$user->student"></x-user.studentdata>
    </div>
</x-app.card>

