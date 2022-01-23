<x-layout.admin>
    <x-slot name="title">
        Assessment
    </x-slot>

    <vue-store-fill :model="'recommendation'"
                    :entity="{{$recommendation}}"></vue-store-fill>
    <vue-store-fill :model="'courseRecommendation'"
                    :entities="{{$recommendation->courseRecommendations}}"></vue-store-fill>
    <vue-store-fill :model="'course'" :entities="{{$recommendation->courses}}"></vue-store-fill>

    <div class="space-y-4">
        <div class="text-2xl text-gray-500 mb-4"> Musterstudienplan
            - {{$recommendation->name}}</div>

        <vue-admin-recommendation :recommendation-id="{{$recommendation->id}}"></vue-admin-recommendation>

    </div>
</x-layout.admin>
