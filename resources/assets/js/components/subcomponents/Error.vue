<template>
    <span class="help-block alert alert-danger" v-if="message">
        <strong>{{ message }}</strong>
        <slot></slot>
    </span>
</template>

<script>

    export default {
        props: ['message']
    }

</script>