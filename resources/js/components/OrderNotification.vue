<template>
        <div class="test hidden">
            <a href="#!" @click.prevent="toggle" class="btn dropdown-button red" data-target="dropdown2" v-if="notifications.length > 0">
                <i class="material-icons">notification_important</i>
            </a>

            <ul id="dropdown2" class="dropdown-content">
                <li v-for="notification in notifications">
                    <a :href="notification.url">
                        <div>
                            <i class="material-icons">notification_important</i>
                            <span class="red ">{{ notification.description || test }}</span>
                        </div>
                        <div>
                            <span class="red">{{ notification.time || test }}</span>
                        </div>
                    </a>
                    <div class="divider"></div>
                </li>
            </ul>
        </div>
</template>

<script>
    export default {
        data() {
            return {
                notifications: [],
                show: false
            }
        },

        mounted() {
            Echo.private('user_ordered')
            .listen('UserOrdered', (order) => {
                this.notifications.push({
                    description: 'Order ID: ' + order.id + ' created',
                    url: '/order/' + order.id,
                    time: new Date().toDateString()
                })

            });
        },

        methods: {
            toggle() {
                this.show = !this.show
            }
        }
    }
</script>
