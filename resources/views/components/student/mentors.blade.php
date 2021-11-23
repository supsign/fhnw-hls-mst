<div>
    <x-app.card>
        <div class="divide-y">
            <div class="pb-2">
                <div>Meine Mentor:innen</div>
            </div>

            <vue-show-and-select-mentors :all-mentors="{{$allMentors}}"
                                         :init-my-mentors="{{$myMentors}}"></vue-show-and-select-mentors>
        </div>
    </x-app.card>
</div>
