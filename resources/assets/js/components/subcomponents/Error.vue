<template>
    <span class="red text-white" v-if="error">
        <strong>{{ error }}</strong>
        <slot></slot>
    </span>
</template>

<script>
    export default {
        props: ['error']
    }
</script>
<style scoped>
    span {
        font-size: 1.5em;
        padding: 0.5em;
    }
</style>