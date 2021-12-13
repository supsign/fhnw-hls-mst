@if($roles->count())
    <div class="flex space-x-2">
        <div>@lang('l.roles'):</div>
        @foreach($roles as $role)
            <div>{{ $role->name }} </div>
        @endforeach
    </div>
@endif
