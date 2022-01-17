<div class="w-full h-auto bg-hls">
    <div class="container flex flex-col md:flex-row justify-between mx-auto px-3">
        <a href="{{ route('home') }}">
            <div class="flex space-x-4">
                <img class="p-2 md:py-4 max-h-12 md:max-h-20" src="{{ asset('img/logos/fhnw-logo-klein.png') }}" alt="Logo FHNW">
                <div class="my-auto text-lg">@lang('l.mst')</div>
                <i class="fas fa-home my-auto text-xl" aria-hidden="true"></i>
            </div>
        </a>
        <a href="{{ route('faq') }}" class="my-auto">
            <div class="flex space-x-4 justify-center lg:justify-start">
                <div class="my-auto text-lg">@lang('l.faq')</div>
            </div>
        </a>
    </div>
</div>
