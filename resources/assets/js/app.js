require('./bootstrap');

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('addtocart', require('./components/addToCart.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('calendar', require('./components/Calendar.vue'));

const app = new Vue({
    el: '#app',

    data: {
        showModal: false,
        selected: '',
    },
});