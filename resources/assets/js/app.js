import './bootstrap';

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('cart-counter', require('./components/CartCounter.vue'));
Vue.component('favorite', require('./components/Favorite.vue'));
Vue.component('past-orders', require('./components/PastOrders.vue'));
Vue.component('add-to-cart', require('./components/AddToCart.vue'));
Vue.component('checkoutform', require('./components/CheckoutForm.vue'));
Vue.component('view-cart', require('./components/ViewCart.vue'));
Vue.component('calendar', require('./components/Calendar.vue'));
Vue.component('order-progress', require('./components/OrderProgress.vue'));
Vue.component('monthly-stats', require('./components/MonthlyStats.vue'));
Vue.component('yearly-stats', require('./components/YearlyStats.vue'));
Vue.component('analytics', require('./components/Analytics.vue'));
Vue.component('toggle', require('./components/Toggle.vue'));
Vue.component("Wysiwig", require("./components/Wysiwig.vue"));
Vue.component('add-holiday-title', require('./components/AddHolidayTitle'))
Vue.component('add-options', require('./components/AddOptions'));
Vue.component('add-option-group', require('./components/AddOptionGroup'));
Vue.component('latest-orders', require('./components/LatestOrders'));
Vue.component('user-orders', require('./components/UserOrders'));
Vue.component('add-categories', require('./components/AddCategories'));
Vue.component('coupons', require('./components/Coupons'));
Vue.component('sales', require('./components/Sales'));
Vue.component('order-notification', require('./components/OrderNotification'));

Vue.component('add-unique-coupons', require('./components/subcomponents/UniqueCoupons'));
Vue.component('add-coupons-for-everyone', require('./components/subcomponents/CouponsForEveryone'));
Vue.component('coupon-layout', require('./components/subcomponents/CouponLayout'));
Vue.component('error', require('./components/subcomponents/Error'));
Vue.component('data-table', require('./components/subcomponents/Table'));



const app = new Vue({
    el: '#app',

    data: {
        checked: false
    }
});