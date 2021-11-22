@if($icon === 1)
    <div class="my-auto text-lg flex-none">
        <i class="far fa-check-circle" aria-hidden="true"></i>
    </div>

@elseif($icon === 2)
    <div class="my-auto text-lg flex-none">
        <i class="far fa-times-circle" aria-hidden="true"></i>
    </div>
@else
    <div class="my-auto text-lg flex-none">
        <i class="far fa-circle" aria-hidden="true"></i>
    </div>
@endif

