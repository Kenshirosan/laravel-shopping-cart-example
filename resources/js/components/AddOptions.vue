<template>
    <div>
        <div class="text-center">
            <h1>Items</h1>
        </div>

        <div class="row">
            <form class="form-horizontal" @submit.prevent="addItems">
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label"
                        >Option Name</label
                    >
                    <div class="col-md-6">
                        <input
                            @focus="clearError"
                            id="name"
                            placeholder="ex: Long sleeve, Short sleeve..."
                            type="text"
                            class="form-control"
                            name="name"
                            v-model="name"
                            autofocus
                            required
                        />
                        <error :error="errors.get('name')"></error>
                    </div>
                </div>

                <div class="form-group">
                    <label for="option" class="col-md-4 control-label"
                        >Option Group</label
                    >
                    <div class="col-md-6">
                        <select
                            id="option_group_id"
                            class="form-control"
                            v-model="option_group_id"
                            required
                        >
                            <option value="" class="reset">Choose</option>
                            <option
                                v-for="optiongroup in items"
                                name="option_group_id"
                                v-bind:key="optiongroup.id"
                                v-bind:value="optiongroup.id"
                            >
                                {{ optiongroup.name }}
                            </option>
                        </select>
                        <error :error="errors.get('option_group_id')"></error>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-4 control-label"></label>
                    <div class="col-md-6">
                        <input
                            type="submit"
                            value="Submit"
                            class="btn btn-primary"
                        />
                    </div>
                </div>
            </form>
        </div>
        <!-- spacer -->
        <div class="mb-100"></div>

        <div class="container" v-if="items">
            <data-table
                id="ID"
                findaname="Option Group"
                :data="this.items"
                :options="this.optionalItems"
            >
            </data-table>
        </div>
    </div>
</template>

<script>
    import requests from '../mixins/requests';

    export default {
        mixins: [requests],

        data() {
            return {
                option_group_id: '',
                name: '',
                items: [],
                optionalItems: [],
            };
        },

        mounted() {
            window.events.$on('erase', data => this.deleteItems(data));
        },
    };
</script>
