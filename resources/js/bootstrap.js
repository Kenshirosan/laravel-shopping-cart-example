try {
    window.$ = window.jQuery = require('jquery');

    require('materialize-css');
} catch (e) {
    // console.log(e);
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.swal = require('sweetalert');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error(
        'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token'
    );
}

window.moment = require('../../bower_components/moment/moment.js');
window.Vue = require('vue');

window.events = new Vue();

window.flash = function (message, level = 'green', duration = 3000) {
    window.events.$emit('flash', { message, level, duration });
};

window.adminflash = function (message, level = 'success') {
    window.events.$emit('adminflash', { message, level });
};

window.productitemscountchanged = function () {
    window.events.$emit('productadded');
};

window.cartisempty = function () {
    window.events.$emit('cartempty');
};

window.specialshavechanged = function () {
    window.events.$emit('specialschanged');
};

window.cartHasDiscount = function (data) {
    window.events.$emit('discount-applied', data);
};

window.ucfirst = function (string) {
    return string.charAt(0).toUpperCase() + string.substring(1);
};

window.erase = function (data) {
    window.events.$emit('erase', data);
};

window.show = function (data) {
    window.events.$emit('show', data);
};

window.addressAdded = function (data) {
    window.events.$emit('address-added', data);
};

// Optional real time order progress
import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'http://localhost:5000',
    // key: '2f56755e1aa83d0d08db',
    // cluster: 'eu',
    // encrypted: true,
});
