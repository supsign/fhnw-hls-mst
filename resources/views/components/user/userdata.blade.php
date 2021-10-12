<div>
    <x-app.card>
        <!-- ToDo mehr Angaben zum Standartuser hinzufügen -->
        <div class="divide-y">
            <div class="pb-2">
                <div>{{ $user->firstname }} {{ $user->lastname }}</div>
                @if($user->role !== 'student')
                    <div>@lang('l.role'): {{ $user->role }}</div>
                @endif
            </div>

            <x-user.studentdata :student="$user->student"></x-user.studentdata>
        </div>
    </x-app.card>
</div>
