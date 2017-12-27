require('./bootstrap');

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('addtocart', require('./components/addToCart.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('calendar', require('./components/Calendar.vue'));
Vue.component('order-progress', require('./components/Progress.vue'));
Vue.component('monthly-stats', require('./components/MonthlyStats.vue'));
Vue.component('yearly-stats', require('./components/YearlyStats.vue'));

const app = new Vue({
    el: '#app',

    data: {
        showModal: false,
        selected: '',
    },
});