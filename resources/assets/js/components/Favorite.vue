<template>
    <button type="submit" :class="classes" @click="toggle">
        <span class="material-icons blue-text" style="padding: 0.2em">favorite</span>
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

            async create() {
                await axios.post(this.endpoint, this.product)
                    .then(res => flash(`You liked ${this.product.name}`))
                    .catch(err => flash(`You need to be authenticated to rate this product`, "danger"));

                this.active = true;
                this.count++;
            },

            async destroy() {
                await axios.delete(this.endpoint, this.product)
                    .then(res => flash(`You unliked ${this.product.name}`))
                    .catch(err => flash(`Something went wrong, please try again later.`, "danger"));
                this.active = false;
                this.count--;
            }
        }
    }
</script>