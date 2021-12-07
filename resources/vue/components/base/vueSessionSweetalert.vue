<template>
    <div></div>
</template>

<style>
@import "https://cdn.jsdelivr.net/npm/animate.css";
</style>

<script lang="ts">
import { Component, Prop } from "vue-property-decorator";

import Swal, { SweetAlertOptions } from "sweetalert2";
import BaseComponent from "./baseComponent";

@Component
export default class VueSessionSweetalert extends BaseComponent {
    @Prop( {
        type: Object
    } )
    swalOption: SweetAlertOptions;

    mounted() {
        Swal.fire( this.swalOption );
    }
}
</script>
