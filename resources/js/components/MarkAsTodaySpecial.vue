<template>
    <div>
        <button
            type="button"
            class="btn purple js-mark-as-today-special"
            v-text="message"
            @click="toggle"
        ></button>
    </div>
</template>

<script>
    export default {
        name: 'MarkAsTodaySpecial',

        props: ['product', 'todayspecial'],

        data() {
            return {
                isTodaySpecial: false,
            };
        },

        mounted() {
            this.isTodaySpecial = this.$props.todayspecial;
        },

        computed: {
            message() {
                return this.isTodaySpecial
                    ? 'Enlever des plats du jour'
                    : 'Ajouter aux plats du jour';
            },
        },

        methods: {
            delete(id) {
                axios
                    .delete(`today/${id}/delete`)
                    .then(res => {
                        this.isTodaySpecial = false;
                        specialshavechanged();
                        flash('Produit effacer des plats du jour', 'orange');
                    })
                    .catch(err => console.error(err.message));
            },

            create(id) {
                axios
                    .post(`today/${id}`)
                    .then(res => {
                        this.isTodaySpecial = true;
                        specialshavechanged();
                        flash('Produit ajouter aux plats du jour');
                    })
                    .catch(err => console.error(err));
            },

            toggle() {
                return this.isTodaySpecial
                    ? this.delete(this.$props.product)
                    : this.create(this.$props.product);
            },
        },
    };
</script>
