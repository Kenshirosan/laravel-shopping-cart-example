<template>
    <button type="submit" :class="classes" class="fav-button" @click="toggle">
        <span class="glyphicon glyphicon-heart"></span>
        <span v-text="count"></span>
    </button>
</template>

<script>
    export default {
        props: ['product'],

        data() {
            return {
                count: this.product.favoritesCount,
                active: this.product.isFavorited
            }
        },

        computed: {
            classes() {
                return [
                    'btn',
                    this.active ? 'btn-primary' : 'btn-default'
                ];
            },

            endpoint() {
                return '/product/' + this.product.id + '/favorites';
            }
        },

        methods: {
            toggle() {
                this.active ? this.destroy() : this.create();
            },

            create() {
                axios.post(this.endpoint, this.product)
                    .then(flash(`You liked ${this.product.name}`))
                    .catch(err => flash(`You need to be authenticated to rate this product`, "danger"));

                this.active = true;
                this.count++;
            },

            destroy() {
                axios.delete(this.endpoint, this.product)
                    .then(flash(`You unliked ${this.product.name}`))
                    .catch(err => flash(`Something went wrong, please try again later.`, "danger"));
                this.active = false;
                this.count--;
            }
        }
    }
</script>

<style>
.fav-button {
    padding: 1em;
}
</style>