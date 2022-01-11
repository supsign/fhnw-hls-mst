<template>
    <div class="p-4 border bg-gray-100 rounded">
        <div class="font-bold pb-3 border-b">{{ faq.question }}</div>
        <div class="pt-3">{{ faq.answer }}</div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {IFaq} from "../../interfaces/faq.interface";

@Component
export default class VueAdminFaq extends BaseComponent {
    @Prop({type: Object})
    public faq: IFaq

}
</script>
