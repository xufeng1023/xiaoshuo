
window._ = require('lodash');

window.Popper = require('popper.js/dist/umd/popper');

try {
    window.$ = window.jQuery = require('jquery/dist/jquery.slim');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    token.remove;
}
