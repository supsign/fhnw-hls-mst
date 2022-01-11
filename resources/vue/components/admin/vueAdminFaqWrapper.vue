<template>
    <div class="p-2 rounded  bg-white flex flex-col shadow-xl">
        <div class="content-center p-2 border-b rounded-t text-base md:text-lg">
            FAQ bearbeiten
        </div>

        <div class="p-3 text-sm md:text-base flex-grow flex flex-col space-y-4">
            <vue-admin-faq v-for="faq in faqs"
                           :key="faq.id"
                           :faq="faq"
                           :faqs="faqs"
                           @remove="remove"
                           @move-up="moveUp"
                           @move-down="moveDown"
            />
            <button class="button-primary" @click="createEmptyFaq">neue FAQ hinzufügen</button>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import VueAdminFaq from "./vueAdminFaq.vue";
import {IFaq} from "../../interfaces/faq.interface";
import axios from "axios";
import {Toast} from "../../helpers/toast";
import Swal from "sweetalert2";

@Component({
    components: {VueAdminFaq}
})
export default class VueAdminFaqWrapper extends BaseComponent {
    @Prop({type: Array})
    public faqs: IFaq[]



    public emptyFaq: IFaq = {
        id: null,
        question: 'Frage',
        answer: 'Antwort',
    }

    public createEmptyFaq() {
        axios.post<IFaq>(`/webapi/faq`, {
            question: this.emptyFaq.question,
            answer: this.emptyFaq.answer,
        })
            .then(res => {
                this.faqs.push(res.data);
                Toast.fire({ icon: "success", title: 'Gespeichert'});
            })
            .catch((reason) => {
                Toast.fire({title: 'Error', icon: 'error', text: reason.text});
                console.log(reason);
            });
    }

    public remove(faq: IFaq) {
        console.log('blub');
        console.log(faq);
        console.log(this.faqs);
        this.faqs.splice(this.faqs.indexOf(faq), 1);
        console.log(this.faqs);
    }

    public moveUp(faq: IFaq) {
        console.log('up', faq);
        axios.post<IFaq>(`/webapi/faq/${faq.id}/up`, {

        })
            .then(() => {
                Toast.fire({
                    icon: "success",
                    title: "FAQ has been moved!"
                });
            })
            .catch(() => {
                Toast.fire({
                    icon: "success",
                    title: "FAQ has been moved!"
                });
            });
    }

    public moveDown(faq: IFaq) {
        console.log('down', faq);
        axios.post<IFaq>(`/webapi/faq/${faq.id}/down`, {

        })
            .then(() => {
                Toast.fire({
                    icon: "success",
                    title: "FAQ has been moved!"
                });
            })
            .catch(() => {
                Swal.fire({
                    text: "Error! FAQ hasn't been moved.",
                    icon: "error"
                });
            });
    }
}
</script>
