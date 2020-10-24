<template>
    <span class="bg-red-gradient text-white" v-if="error">
        <strong>{{ error }}</strong>
        <slot></slot>
    </span>
</template>

<script>
    export default {
        props: ['error'],
    };
</script>
<style scoped>
    span {
        margin-top: 5px;
        font-size: 1em;
        padding: 0.5em;
    }
</style>
