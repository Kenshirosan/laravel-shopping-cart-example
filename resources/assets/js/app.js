import './bootstrap';

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('cart-counter', require('./components/CartCounter.vue'));
Vue.component('past-orders', require('./components/PastOrders.vue'));
Vue.component('add-to-cart', require('./components/AddToCart.vue'));
Vue.component('checkoutform', require('./components/CheckoutForm.vue'));
Vue.component('view-cart', require('./components/ViewCart.vue'));
Vue.component('calendar', require('./components/Calendar.vue'));
Vue.component('order-progress', require('./components/Progress.vue'));
Vue.component('monthly-stats', require('./components/MonthlyStats.vue'));
Vue.component('yearly-stats', require('./components/YearlyStats.vue'));
Vue.component('analytics', require('./components/Analytics.vue'));


const app = new Vue({
    el: '#app',

    // data: {
    //     selected: '',
    // }
});