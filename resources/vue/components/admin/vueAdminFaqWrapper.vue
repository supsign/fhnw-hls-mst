<template>
    <div class="p-2 rounded  bg-white flex flex-col shadow-xl">
        <div class="content-center p-2 border-b rounded-t text-base md:text-lg">
            FAQ bearbeiten
        </div>

        <div class="p-3 text-sm md:text-base flex-grow flex flex-col space-y-4">
            <vue-admin-faq v-for="faq in faqs"
                           :key="faq.id"
                           :faq="faq"
            />
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueAdminFaq from "./vueAdminFaq.vue";
import {IFaq} from "../../interfaces/faq.interface";

@Component({
    components: {VueAdminFaq}
})
export default class VueAdminFaqWrapper extends BaseComponent {
    @Prop({type: Array})
    public faqs: IFaq[]

}
</script>
