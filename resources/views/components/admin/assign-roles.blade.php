<x-app.card>
    <x-slot name="title">
        Assign Roles
    </x-slot>
    <div class="text-center">
        <vue-form>
            @csrf
            <div class="flex flex-row space-x-8">
                <x-base.input type="text" name="user" label="User" value="{{ old('user') }}" :init-errors="$errors->get('user')"/>       
                <x-base.select 
                    clearable 
                    name="select_userid"
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
