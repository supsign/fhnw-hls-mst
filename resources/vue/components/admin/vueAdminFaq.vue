<template>
    <div class="flex space-x-4">
        <div class="p-4 border bg-gray-100 rounded w-full">
            <div class="flex justify-between border-b">
                <div class="font-bold pb-3">{{ faq.question }}</div>
                <div class="flex space-x-2">
                    <div
                        class="text-blue-600 hover:font-bold"
                        :class="{ 'text-gray-100 cursor-not-allowed':  !editMode, 'cursor-pointer' : editMode}"
                        @click="save()">
                        <i class="far fa-save" aria-hidden="true"></i>
                    </div>
                    <div
                        class="text-blue-600 hover:font-bold"
                        :class="{ 'text-gray-100 cursor-not-allowed':  editMode , 'cursor-pointer' : !editMode}"
                        @click="edit()">
                        <i class="far fa-edit" aria-hidden="true"></i>
                    </div>
                    <div class="cursor-pointer text-red-500 hover:font-bold"
                         @click="()=>remove(faq)">
                        <i class="far fa-trash" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="pt-3">{{ faq.answer }}</div>
        </div>
        <div class="text-xl h-auto my-auto">
            <div v-if="minSortOrder !== faq.sort_order" @click="()=>moveUp(faq)">
                <i class="fas fa-arrow-circle-up cursor-pointer" aria-label="hidden"></i>
            </div>
            <div v-if="maxSortOrder !== faq.sort_order" @click="()=>moveDown(faq)">
                <i class="fas fa-arrow-circle-down cursor-pointer" aria-label="hidden"></i>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Emit, Prop} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {IFaq} from "../../interfaces/faq.interface";
import Swal from "sweetalert2";
import axios from "axios";
import {Toast} from "../../helpers/toast";

@Component
export default class VueAdminFaq extends BaseComponent {
    @Prop({type: Object})
    public faq: IFaq

    @Prop({type: Array})
    public faqs: IFaq[]

    editMode = false;
    question: string = null;
    answer: string = null;

    public get minSortOrder() {
        return Math.min.apply(Math, this.faqs.map(function(faq) {
            return faq.sort_order; }));
    }

    public get maxSortOrder() {
        return Math.max.apply(Math, this.faqs.map(function(faq) {
            return faq.sort_order; }));
    }

    public edit() {
        if(!this.editMode) {
            this.editMode = true;
        }
        else {
            return;
        }
    }

    remove() {
        if (!this.faq.id) {
            return this.faq;
        }
        Swal.fire({
            title: 'Warnung',
            text: 'Bist du sicher dass du diese FAQ löschen willst?',
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: 'Abbrechen',
            confirmButtonText: 'Ja'
        }).then((result) => {
            if(result.isConfirmed) {
                return axios
                    .delete(
                        `/webapi/faq/${this.faq.id}`
                    )
                    .then(() => {
                        Toast.fire({icon: "success", title: 'Die FAQ wurde gelöscht.'});
                        this.$emit('remove', this.faq);
                    })
                    .catch((reason) => {
                        Toast.fire({title: 'Error', icon: 'error', text: reason.text});
                        console.log(reason);
                    });
            }
        });
    }

    save() {
        if(this.editMode) {
            this.editMode = false;
            this.store();
        }
        else {
            return;
        }
    }

    store() {
        if (!this.faq.id) {
            return this.faq;
        }
        return axios
            .patch(
                `/webapi/faq/${this.faq}`, {
                    question: this.question,
                    answer: this.answer,
                }
            )
            .then(() => {
                Toast.fire({icon: "success", title: 'Gespeichert'});
            })
            .catch((reason) => {
                Toast.fire({title: 'Error', icon: 'error', text: reason.text});
                console.log(reason);
            });
    }

    @Emit()
    public moveUp(faq: IFaq) {
        return faq;
    }

    @Emit()
    public moveDown(faq: IFaq) {
        return faq;
    }

}
</script>
