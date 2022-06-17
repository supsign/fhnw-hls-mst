<template>
    <vue-checkbox v-model="isLocked" :label="'für Student:in schreibgeschützt'" @input="toggle"></vue-checkbox>
</template>

<script lang="ts">
import { Component, Prop } from 'vue-property-decorator';
import BaseComponent from '../base/baseComponent';
import VueCheckbox from '../form/vueCheckbox.vue';
import { IPlanning } from '../../interfaces/planning.interface';
import axios from 'axios';
import { Toast } from '../../helpers/toast';

@Component({
    components: {
        VueCheckbox,
    },
})
export default class VueLockPlanning extends BaseComponent {
    @Prop({ type: Object })
    public planning: IPlanning;

    public isLocked = false;

    public mounted() {
        this.isLocked = this.planning.is_locked;
    }

    public toggle(isLocked: boolean) {
        if (isLocked) {
            return this.lock();
        }

        this.unLock();
    }

    public lock() {
        axios
            .post<IPlanning>(`/webapi/plannings/${this.planning.id}/lock`)
            .then((res) => {
                this.isLocked = res.data.is_locked;
                Toast.fire({ icon: 'success', title: 'Schreibschutz für Stundent:in aktiviert' });
            })
            .catch(() => {
                this.isLocked = false;
                Toast.fire({ icon: 'error', title: 'Schreibschutz für Stundent:in nicht aktiviert' });
            });
    }

    public unLock() {
        axios
            .post<IPlanning>(`/webapi/plannings/${this.planning.id}/unlock`)
            .then((res) => {
                this.isLocked = res.data.is_locked;
                Toast.fire({ icon: 'success', title: 'Schreibschutz für Stundent:in aufgehoben' });
            })
            .catch(() => {
                this.isLocked = true;
                Toast.fire({ icon: 'error', title: 'Schreibschutz für Stundent:in nicht aufgehoben' });
            });
    }
}
</script>
