<template>
    <vue-select
        :clearable="clearable"
        :disabled="disabled"
        :filterable="false"
        :label="label"
        :name="name"
        :option-key="optionKey"
        :options="options"
        :required="required"
        :searchable="true"
        :selectable="selectable"
        :show-option="showOption"
        :value="value"
        @input="input"
        @search="performBackendQuery"
    ></vue-select>
</template>

<script lang="ts">
import {Component, Emit, Prop} from "vue-property-decorator";

import VueSelect from "./vueSelect.vue";

import axios, {CancelTokenSource} from "axios";
import BaseComponent from "../base/baseComponent";
import {IModel} from "../../store/model.interface";

@Component({
    components: {
        VueSelect
    }
})
export default class VueBackendSelect extends BaseComponent {
    @Prop({
        type: [Object, String, Number]
    })
    value: IModel | string | number;

    @Prop({
        type: String,
        default: "id"
    })
    optionKey: string;

    @Prop({
        type: String,
        default: ""
    })
    name: string;

    @Prop({
        type: String,
        default: ""
    })
    label: string;

    @Prop({
        type: Boolean,
        default: false
    })
    clearable: boolean;

    @Prop({
        type: Boolean,
        default: false
    })
    disabled: boolean;

    @Prop({
        type: Boolean,
        default: false
    })
    required: boolean;

    @Prop({
        type: Function
    })
    selectable: (option: any) => boolean;

    @Prop({
        type: Function
    })
    showOption: (option: any) => string;

    @Prop({type: String})
    backendSearchUrl: string

    @Prop({type: Function})
    getBackendSearchParams: (searchString: string) => { [key: string]: any }
    public options: any[] = [];

    public source: CancelTokenSource = null;

    @Emit()
    input(obj: any) {
        return obj
    }

    public performBackendQuery(searchCallBack: { search: string, loading: (state: boolean) => void }) {
        if (!this.backendSearchUrl || !this.getBackendSearchParams) {
            return;
        }

        if (!searchCallBack.search) {
            return;
        }


        if (this.source) {
            this.source.cancel();
            this.source = null
        }

        searchCallBack.loading(true);

        this.source = axios.CancelToken.source();
        axios.get<any[]>(this.backendSearchUrl, {
            params: this.getBackendSearchParams(searchCallBack.search),
            cancelToken: this.source.token
        })
            .then(
                (res) => {
                    searchCallBack.loading(false);
                    this.options = res.data;
                    this.source = null;
                }
            ).catch((reason) => {
            if (reason instanceof axios.Cancel) {
                return
            }
            searchCallBack.loading(false);
        });
    }
}
</script>
