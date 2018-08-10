<template>
    <span class="help-block alert alert-danger" v-if="error">
        <strong>{{ error }}</strong>
        <slot></slot>
    </span>
</template>

<script>
    export default {
        props: ['error']
    }
</script>