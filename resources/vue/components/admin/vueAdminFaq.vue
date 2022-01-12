<template>
    <div class="flex space-x-4">
        <div class="p-4 border bg-gray-100 rounded flex-grow">
            <div class="flex justify-between border-b">
                <div v-if="!editMode"
                    class="font-bold pb-3 flex space-x-4">
                    <div>
                        {{ question }}
                    </div>
                    <div v-if="deletedAt"
                         class="text-red-500 text-sm my-auto"
                    >
                        Gelöscht
                    </div>
                </div>
                <vue-input v-else
                           v-model="question"
                           class="w-3/4 pb-4"
                           type="text"
                           name="name"
                           label="Frage"
                />
                <div class="flex space-x-2">
                    <div v-if="editMode && !deletedAt"
                        class="hover:font-bold"
                        :class="{ 'text-gray-400 cursor-not-allowed':  !editMode, 'cursor-pointer text-blue-600' : editMode}"
                        @click="save()">
                        <i class="far fa-save" aria-hidden="true"></i>
                    </div>
                    <div v-if="!editMode && !deletedAt"
                        class=" hover:font-bold"
                        :class="{ 'text-gray-400 cursor-not-allowed':  editMode , 'cursor-pointer text-blue-600' : !editMode}"
                        @click="edit()">
                        <i class="far fa-edit" aria-hidden="true"></i>
                    </div>
                    <div v-if="!deletedAt"
                        class="cursor-pointer text-red-500 hover:font-bold"
                         @click="remove()">
                        <i class="far fa-trash" aria-hidden="true"></i>
                    </div>
                    <div v-if="deletedAt"
                        class="cursor-pointer hover:font-bold">
                        <i class="far fa-trash-undo text-green-500" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div v-if="!editMode"
                class="pt-3">{{ answer }}</div>
            <vue-input v-else
                       v-model="answer"
                       class="w-94 pt-2"
                       type="text"
                       name="name"
                       label="Antwort"
            />
        </div>
        <div class="text-xl h-auto my-auto w-8">
            <div  v-if="!deletedAt">
                <div v-if="minSortOrder !== faq.sort_order" @click="()=>moveUp(faq)">
                    <i class="fas fa-arrow-circle-up cursor-pointer" aria-label="hidden"></i>
                </div>
                <div v-if="maxSortOrder !== faq.sort_order" @click="()=>moveDown(faq)">
                    <i class="fas fa-arrow-circle-down cursor-pointer" aria-label="hidden"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import {Component, Emit, Prop, Watch} from "vue-property-decorator";
import BaseComponent from "../base/baseComponent";
import {IFaq} from "../../interfaces/faq.interface";
import Swal from "sweetalert2";
import axios from "axios";
import {Toast} from "../../helpers/toast";
import VueInput from "../form/vueInput.vue";

@Component({
    components: {VueInput}
})
export default class VueAdminFaq extends BaseComponent {
    @Prop({type: Object})
    public faq: IFaq

    @Prop({type: Array})
    public faqs: IFaq[]

    editMode = false;
    question: string = null;
    answer: string = null;
    sortOrder: number = null;
    deletedAt: string = null;

    public created() {
        this.question = this.faq.question;
        this.answer = this.faq.answer;
        this.sortOrder = this.faq.sort_order;
        this.deletedAt = this.faq.deleted_at;
    }

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
                `/webapi/faq/${this.faq.id}`, {
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
