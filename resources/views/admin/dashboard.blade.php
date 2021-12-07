<x-layout.admin>
    <x-slot name="title">
        @lang('l.dashboard')
    </x-slot>

        <x-app.card class="flex flex-col overflow-hidden w-full rounded-none">
            <x-slot name="title">
                @lang('l.dashboard')
            </x-slot>
            <div class="text-center">
                <span class="font-heading text-3xl">You are Awesome and at least a super-admin!</span>
            </div>
        </x-app.card>
</x-layout.admin>
