<x-app.card>
    <!-- ToDo mehr Angaben zum Standartuser hinzufügen -->
    <div class="divide-y">
        <div class="pb-2">
            <div>{{ $user->firstname }} {{ $user->lastname }}</div>
            @if($user->hasRole('mentor'))
                <div>@lang('l.role'): @lang('l.mentor')</div>
            @endif
        </div>

        <x-user.studentdata :student="$user->student"></x-user.studentdata>
    </div>
</x-app.card>

