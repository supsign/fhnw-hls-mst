<div class="w-full h-auto bg-hls">
    <div class="container flex flex-col md:flex-row justify-between mx-auto px-3">
        <div class="flex">
            <a href="{{ route('home') }}">
                <img class="p-2 md:p-4 max-h-12 md:max-h-20" src="{{ asset('img/logos/fhnw-logo-klein.png') }}" alt="Logo FHNW">
            </a>
            <div class="my-auto text-lg">Modul Selektionstool</div>
        </div>
        <div class="flex divide-x divide-black text-lg">
            <a class="my-auto px-6" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="my-auto px-6" href="{{ route('user.index') }}">About me</a>
        </div>
    </div>
</div>
