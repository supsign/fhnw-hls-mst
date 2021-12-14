@if($roles)
    <div class="flex space-x-2">
        <div>@lang('l.roles'):</div>
        @foreach($roles as $role)
            <div>{{ $role }} </div>
        @endforeach
    </div>
@endif
