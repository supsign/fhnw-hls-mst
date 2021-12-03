<x-layout.admin>
    <x-slot name="title">
        @lang('l.roleAssign')
    </x-slot>

    <x-app.card class="mb-4">
        <x-slot name="title">
            @lang('l.roleAssign')
        </x-slot>
        <div>
            <div>
                Einem User mittels User-ID eine Rolle zuweisen.
            </div>
            <vue-form method="POST" action="{{ route('admin.userManagement.assign.post') }}" class="mt-5">
                @csrf
                <div class="flex flex-row space-x-8">
                    <x-base.input type="text" name="user_id" label="User" value="{{ old('user_id') }}" :init-errors="$errors->get('user_id')" required />
                    <x-base.select
                        clearable
                        required
                        name="role_id"
                        :options="$roles"
                        optionKey="name"
                        label="Select Role"
                        >
                    </x-base.select>
                </div>
                <div class="flex justify-start mt-7">
                    <x-base.button class="button-primary w-36" type="submit">@lang('l.save')</x-base.button>
                </div>
            </vue-form>
        </div>
    </x-app.card>

    <x-app.card>
        <x-slot name="title">
            @lang('l.roleRemove')
        </x-slot>
        <div>
            <div>
                Einem User mittels User-ID eine Rolle wegnehmen.
            </div>
            <vue-form method="POST" action="{{ route('admin.userManagement.remove.post') }}" class="mt-5">
                @csrf
                <div class="flex flex-row space-x-8">
                    <x-base.input type="text" name="user_id" label="User" value="{{ old('user_id') }}" :init-errors="$errors->get('user_id')" required />
                    <x-base.select
                        clearable
                        required
                        name="role_id"
                        :options="$roles"
                        optionKey="name"
                        label="Select Role"
                        >
                    </x-base.select>
                </div>
                <div class="flex justify-start mt-7">
                    <x-base.button class="button-primary w-36" type="submit">@lang('l.save')</x-base.button>
                </div>
            </vue-form>
        </div>
    </x-app.card>
</x-layout.admin>
