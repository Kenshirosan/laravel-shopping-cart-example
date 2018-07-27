<template>
    <div class="container">
        <input id="trix" type="hidden" :name="name" :value="value">

        <trix-editor
            ref="trix"
            input="trix"
            @trix-change="change"
            :value="value"
            :placeholder="placeholder">
        </trix-editor>
        <button type="submit" class="btn btn-primary btn-xs" @click.prevent="send">Submit</button>
    </div>
</template>

<style lang="scss">
    @import '~trix/dist/trix.css';
    trix-editor {
        height: 40em;
    }
</style>

<script>
    import Trix from 'trix';

    export default {
        props: ['name','placeholder'],

        data() {
            return {
                value: '',
                about: ''
            }
        },

        async mounted() {
            await axios.get('/about')
                .then(res => this.$refs.trix.value = res.data.about);
            },

        watch: {
            value(val) {
                if (val === '') {
                    this.$refs.trix.value = '';
                }
            }
        },
        methods: {
            change({target}) {
                this.value = this.$refs.trix.value
            },

            async send() {
                await axios.put('/add-about-page', this.$data)
                    .then(flash('Success'))
                    .catch(e => console.log(e));
            }
        }
    }
</script>