<x-layout.admin>
    <x-slot name="title">
        @lang('l.dashboard')
    </x-slot>

    <div class="container p-3 mx-auto">
        <x-app.card>
            <x-slot name="title">
                @lang('l.dashboard')
            </x-slot>
            <div class="text-center">
                <span class="font-heading text-3xl">You are Awesome and at least a super-admin!</span>
            </div>
        </x-app.card>
        <x-admin.assign-roles></x-admin.assign-roles>
    </div>
</x-layout.admin>
