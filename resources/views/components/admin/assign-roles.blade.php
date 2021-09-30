<x-app.card>
    <x-slot name="title">
        Assign Roles
    </x-slot>
    <div class="text-center">
        <vue-form>
            @csrf
            <div class="flex flex-col space-y-6">
                <x-base.input type="text" name="user" label="User" value="{{ old('user') }}" :init-errors="$errors->get('user')"/>
                <x-base.select clearable name="select" optionKey="name" label="select"></x-base.select>
                <x-base.button class="mt-4 button-primary w-36 justify-center" type="submit">@lang('l.save')</x-base.button>
            </div>
        </vue-form>
    </div>
</x-app.card>
