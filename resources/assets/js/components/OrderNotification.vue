<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <i class="glyphicon glyphicon-bell"></i>
            <span class="notification-count label label-danger" v-if="notifications.length > 0">{{ notifications.length }}</span>
            <span class="caret"></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-notifications" role="menu">
            <li v-if="notifications.length > 0" v-for="notification in notifications">
                <a :href="notification.url">
                    <div>
                        <i class="fa fa-exclamation-circle fa-fw"></i> {{ notification.description }}
                        <span class="pull-right text-muted small">
                        </span>
                    </div>
                    <div>
                        <i class="fa fa-exclamation-circle fa-fw"></i> {{ notification.time }}
                        <span class="pull-right text-muted small"></span>
                    </div>
                </a>
                <div class="divider"></div>
            </li>
            <li v-else>
                <div class="text-center see-all-notifications">
                    <div>No notifications</div>
                </div>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                notifications: []
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
        }
    }
</script>
