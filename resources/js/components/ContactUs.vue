<template>
    <div class="row">
        <form role="form" @submit.prevent="addItems" @click="clearError">
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input type="email" name="email" v-model="email" class="black-text" required>
                <label for="email">Email</label>
                <error :error="errors.get('email')"></error>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input type="text" name="name" v-model="name" class="black-text" required>
                <label for="name">Name</label>
                <error :error="errors.get('name')"></error>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">phone</i>
                <input type="tel" maxlength="10" v-model="phone" name="phone" class="black-text" required>
                <label for="phone">Phone number format(1234568900)</label>
                <error :error="errors.get('phone')"></error>
            </div>
        <!-- textarea -->
            <div class="input-field col s12">
                <i class="material-icons prefix">message</i>
                <textarea class="materialize-textarea black-text" v-model="message"  name="message"></textarea>
                <label for="message">Your message (20 characters minimum)</label>
                <error :error="errors.get('message')"></error>
            </div>
            <div class="input-field col s12">
                <input type="submit" name="submit" class="btn btn-success" value="Submit">
            </div>
        </form>
    </div>
</template>

<script>
    import requests from '../mixins/requests.js'

    export default {
        mixins: [requests],

        data() {
            return {
                name: '',
                email: '',
                phone: '',
                message: ''
            }
        }
    }
</script>