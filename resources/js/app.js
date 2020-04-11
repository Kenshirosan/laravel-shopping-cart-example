import './bootstrap';


Vue.component('adminflash', require('./components/AdminFlash.vue').default);
Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('cart-counter', require('./components/CartCounter.vue').default);
Vue.component('favorite', require('./components/Favorite.vue').default);
Vue.component('past-orders', require('./components/PastOrders.vue').default);
Vue.component('add-to-cart', require('./components/AddToCart.vue').default);
Vue.component('checkoutform', require('./components/CheckoutForm.vue').default);
Vue.component('view-cart', require('./components/ViewCart.vue').default);
Vue.component('calendar', require('./components/Calendar.vue').default);
Vue.component('order-progress', require('./components/OrderProgress.vue').default);
Vue.component('monthly-stats', require('./components/MonthlyStats.vue').default);
Vue.component('yearly-stats', require('./components/YearlyStats.vue').default);
Vue.component('analytics', require('./components/Analytics.vue').default);
Vue.component('toggle', require('./components/Toggle.vue').default);
Vue.component("Wysiwig", require("./components/Wysiwig.vue").default);
Vue.component('add-holiday-title', require('./components/AddHolidayTitle').default);
Vue.component('add-options', require('./components/AddOptions').default);
Vue.component('add-option-group', require('./components/AddOptionGroup').default);
Vue.component('latest-orders', require('./components/LatestOrders').default);
Vue.component('user-orders', require('./components/UserOrders').default);
Vue.component('add-categories', require('./components/AddCategories').default);
Vue.component('coupons', require('./components/Coupons').default);
Vue.component('sales', require('./components/Sales').default);
Vue.component('order-notification', require('./components/OrderNotification').default);
Vue.component('global-order-notification', require('./components/GlobalOrderNotification').default);
Vue.component('best-customers', require('./components/BestCustomers').default);
Vue.component('contact-us', require('./components/ContactUs').default);

Vue.component('add-unique-coupons', require('./components/subcomponents/UniqueCoupons').default);
Vue.component('add-coupons-for-everyone', require('./components/subcomponents/CouponsForEveryone').default);
Vue.component('coupon-layout', require('./components/subcomponents/CouponLayout').default);
Vue.component('error', require('./components/subcomponents/Error').default);
Vue.component('data-table', require('./components/subcomponents/Table').default);



const app = new Vue({
    el: '#app',

    data: {
        checked: false
    }
});