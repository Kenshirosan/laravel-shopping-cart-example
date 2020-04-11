<template>
    <div></div>
</template>

<script>
    export default {
        mounted() {
            Echo.private('user_ordered')
                .listen('UserOrdered', (order) => {
                    flash('New Order', 'success', 7000);
                });
        }
    }
</script>
