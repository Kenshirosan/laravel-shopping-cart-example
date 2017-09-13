<template>
    <div>
        <form action="" method="POST">
            <div id="myModal" v-if="showModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Steak or Eggs ?</h4>
                        </div>
                        <div class="modal-body">
                            <div class="radio">
                                <label><input type="radio" name="product_type" v-model="product" value="steak">Steak</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="product_type" v-model="product" value="eggs">Eggs</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" @click.prevent="update" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

    export default {
        data() {
            return{
                showModal: true,
                product: ''
            }
        },

        methods: {
            update() {
                axios.post('/product_type', this.$data).then(flash('ok'));
            }
        }
    }
</script>