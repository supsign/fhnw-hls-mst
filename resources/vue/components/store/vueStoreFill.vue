<template>
    <div class="hidden"></div>
</template>

<script lang="ts">
import { Component, Prop } from "vue-property-decorator";


import BaseComponent from "../base/baseComponent";
import {parseDatesInModel} from "../../helpers/interceptors/parseDates";

@Component
export default class VueStoreFill extends BaseComponent {
    @Prop({
        type: Object
    })
    entity: any;

    @Prop({
        type: Array
    })
    entities: Array<any>;

    @Prop({
        type: String
    })
    model: string;

    public created() {
        if (!this.$store.state[this.model]) {
            return;
        }

        if (this.entity) {
            this.$store.dispatch(
                this.model + "/add",
                parseDatesInModel(this.entity)
            );
        }

        if (this.entities) {
            this.entities.forEach(entity => {
                parseDatesInModel(entity);
            });
            if (this.entities.length > 20) {
                this.$store.dispatch(
                    this.model + "/initMultiple",
                    this.entities
                );
            } else {
                this.entities.forEach(entity => {
                    this.$store.dispatch(this.model + "/add", entity);
                });
            }
        }
    }
}
</script>
