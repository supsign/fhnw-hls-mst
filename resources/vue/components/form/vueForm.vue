<template>
    <form novalidate @submit="submit">
        <slot></slot>
    </form>
</template>

<script lang="ts">
import { Component } from 'vue-property-decorator';
import { FormControl } from '../../helpers/validation/formControl';
import BaseComponent from '../base/baseComponent';

@Component
export default class VueForm extends BaseComponent {
    formControl = new FormControl();
    fieldControlComponents: Vue[] = [];

    mounted() {
        this.getFieldControls(this.$children);
    }

    submit(event: Event) {
        for (const component of this.fieldControlComponents) {
            // @ts-ignore
            component.isTouched = true;
        }
        if (!this.formControl.isValid) {
            event.preventDefault();
        }
    }

    getFieldControls(children: Vue[]) {
        for (const child of children) {
            // @ts-ignore
            if (child.fieldControl) {
                // @ts-ignore
                this.formControl.addFieldControl(child.fieldControl);
                this.fieldControlComponents.push(child);
            }
            this.getFieldControls(child.$children);
        }
    }
}
</script>
