<vue-plan-wrapper>
    <template v-slot:header>
        <div class="my-auto w-2/3 hyphens-auto text-sm">
            Weitere abgeschlossene Module
        </div>
        <div class="py-1 px-2 mx-auto w-16 h-full">&nbsp;</div>

    </template>
    @foreach($completions as $completion)
        <div class="flex border-t p-1 text-left text-xs lg:text-sm">
            <div class="w-8 flex-none">
                <div class="my-auto text-lg flex-none">
                    <i class="far fa-check-circle" aria-hidden="true"></i>
                </div>
            </div>
            <div
                class="my-auto hyphens-auto flex-grow overflow-auto">
                {{$completion->courseYear->course->name}}
            </div>
        </div>
    @endforeach
</vue-plan-wrapper>
