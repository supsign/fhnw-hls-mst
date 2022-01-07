<x-app.card>
    <div class="divide-y">
        <div class="pb-2">
            <div>{{ $user->firstname }} {{ $user->lastname }}</div>
            <x-user.role :user="$user"></x-user.role>

            @if($user->can('show backend'))
                <div class="mb-2 mt-4 text-center flex md:flex-none">
                    <a class="button-primary md:w-auto" href="{{ route('admin.dashboard') }}">@lang('l.dashboard')</a>
                </div>
            @endif
        </div>

        <x-user.studentdata :student="$user->student"></x-user.studentdata>

        <div class="py-2">
            <x-base.link href="https://welcome.inside.fhnw.ch/organisation/hochschule/HLS/Studierende/Seiten/Bachelor.aspx" target="_blank" rel="noopener noreferrer" class="flex space-x-2">
                <i class="fas fa-external-link text-blue-600 my-auto" aria-hidden="true"></i>
                <div class="my-auto">
                    @lang('l.linkInside')
                </div>
            </x-base.link>
        </div>
    </div>
</x-app.card>

