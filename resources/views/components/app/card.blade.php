<div>
    <div class="p-4 bg-white rounded shadow">

        @isset($title)
            <div class="flex content-center justify-between p-3 border-b rounded-t-lg bg-lightgray-300">
                {{ $title }}
            </div>
        @endisset

        <div class="p-3">
            {{ $slot }}
        </div>

        @isset($footer)
            <div class="flex content-center justify-between p-3">
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
