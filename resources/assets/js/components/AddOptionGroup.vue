<template>
    <div>
        <h1
            v-if="this.URI === '/second-option-group'"
            class="text-center text-primary"
            >Add a Second Option Group
        </h1>
        <h1 class="text-center text-primary" v-else>Add an Option Group</h1>

        <form class="form-horizontal" @submit.prevent="addItems()">
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Option Group Name</label>
                <div class="col-md-6">
                    <input
                        @focus="clearError()"
                        id="name"
                        placeholder="Steak, Eggs,something that have many ways of serving.."
                        type="text"
                        class="form-control"
                        name="name"
                        v-model="name" autofocus required
                    >
                   <error :message="`${this.error}`"></error>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-6">
                    <input type="submit" value='Submit' class="btn btn-primary">
                </div>
            </div>
        </form>

        <div class="mb-100"></div>

        <div class="container" v-if="items">
            <data-table
                @erase="deleteItems($event)"
                id="ID"
                findaname="Option Group"
                :data="this.items"
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
                error: '',
                name: '',
                items: '',
                optionalItems: '',
            }
        }
    }
</script>