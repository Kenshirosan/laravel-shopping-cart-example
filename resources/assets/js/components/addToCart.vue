<template>
    <input type="submit" @click.prevent="addtocart()" class="btn btn-success" value="Add To Cart">
</template>

<script>
    export default {
        props: ['product', 'selected'],

        data() {
            return {
                id: this.product.id,
                quantity: 1,
                name: this.product.name,
                price: this.product.price,
                options: ''
            }
        },

        watch: {
            selected: function() {
                return this.options = this.selected;
            },
            update: function() {
                return this.options = this.newData;
            }
        },

        computed: {
            originalData: {
                get: function(){
                    return this.data = this.selected;
                },
                set: function(){
                    return this.data = '';
                },
            },
            newData: {
                get: function () {
                    return this.newdata = ''
                },
                set: function () {
                    return this.options = this.newdata
                }
            }
        },
        methods: {
            addtocart() {
                    axios.post('/cart/', this.$data)
                        .then(flash(this.product.name + ' was added to cart'))
                        .then( setTimeout( function() {
                            let select = document.getElementsByClassName('options');
                            let i = 0;
                            while ( i < select.length) {
                                let option = select.options.selectedIndex = 0;
                                $(option).trigger('click')
                                i++;
                            }
                        }, 500)
                    )
                },

            remove() {
                axios.delete('/cart/', this.$data).then(flash(this.product.name + 'removed !'));
            }
        }
    }
</script>

<style>
    .option{
        color: orangered;
    }
    .reset {
        color: red;
    }
</style>