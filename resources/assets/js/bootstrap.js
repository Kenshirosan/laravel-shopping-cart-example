try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {
    // console.log(e);
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


window.moment = require('moment');
window.Vue = require('vue');

window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', { message, level });
};

window.productitemscountchanged = function () {
    window.events.$emit('productadded');
};

window.cartisempty = function () {
    window.events.$emit('cartempty');
};

// Optional real time order progress
import Echo from 'laravel-echo'
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '2f56755e1aa83d0d08db',
    cluster: 'eu',
    encrypted: true
});

// window.ucfirst = function (string) {
//     return string.charAt(0).toUpperCase() + name.substring(1);
// }