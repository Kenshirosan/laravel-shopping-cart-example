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
                    ? 'Enlever des PDJ'
                    : 'Ajouter aux PDJ';
            },
        },

        methods: {
            delete(id) {
                axios
                    .delete(`today/${id}/delete`)
                    .then(res => {
                        this.isTodaySpecial = false;
                        specialshavechanged();
                        flash('Produit effacer des PDJ', 'orange');
                    })
                    .catch(err => console.error(err.message));
            },

            create(id) {
                axios
                    .post(`today/${id}`)
                    .then(res => {
                        this.isTodaySpecial = true;
                        specialshavechanged();
                        flash('Produit ajouter aux plats du PDJ');
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
