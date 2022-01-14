<x-layout.app>
    <x-slot name="title">
        @lang('l.faq')
    </x-slot>

    <div class="container p-3 mx-auto space-y-4 mt-2">
        <x-app.card class="mb-4">
            <div class="border-b pb-2 text-lg">
                @lang('l.faq')
            </div>

            <div class="pt-4 grid grid-cols-1 md:grid-cols-2 4xl:grid-cols-3 gap-4">
                @foreach ($faqs AS $faq)
                    <div class="p-4 border bg-gray-100 rounded">
                        <div class="font-bold pb-3 border-b">{{ $faq->question }}</div>
                        <div class="pt-3 tinymce">{!! $faq->answer !!}</div>
                    </div>
                @endforeach
            </div>
        </x-app.card>
    </div>
</x-layout.app>
