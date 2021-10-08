<div>
    <div class="p-2 bg-white rounded shadow mb-4">

        @isset($title)
            <div class="content-center p-2 border-b rounded-t text-lg">
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
