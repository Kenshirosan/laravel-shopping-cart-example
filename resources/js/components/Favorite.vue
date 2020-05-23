<template>
    <button type="submit" class="btn-small purple lighten-2" @click="toggle">
        <span :class="classes" class="material-icons" style="padding: 0.2em">favorite</span>
        <span class="white-text" v-if="count > 0" v-text="count"></span>
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
                return this.active ? 'deep-green' : 'white-text'
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
                    .then(res => {
                        flash(`Vous avez liké ${this.product.name}`);
                        this.active = true;
                        this.count++;
                    })
                    .catch(err => flash(`Vous devez être authentifiez et avoir commandé pour liker ce produit`,
                        "red"));

            },

            async destroy() {
                await axios.delete(this.endpoint, this.product)
                    .then(res => {
                        flash(`Vous unlikez ce produit: ${this.product.name}`);
                        this.active = false;
                        this.count--;
                    })
                    .catch(err => flash(`Quelque chose n'a pas fonctionné, ré-essayer plus tard.`, "red"));
            }
        }
    }
</script>

<style>
    .deep-green {
        color: #89FF00;
    }
</style>