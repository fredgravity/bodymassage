//ALL JS FOR WEBPACK COMPILATION WILL COME HERE


// be part of window
window.$ = window.jquery = require('jquery');

window.axios = require('axios');

window.vue = require('vue');

window.flatpickr = require('flatpickr');


require('foundation-sites/dist/js/foundation.min');


//other dependencies
require('slick-carousel/slick/slick.min');

require('chart.js/dist/Chart.bundle');

require('jquery-confirm/dist/jquery-confirm.min');

require('flatpickr/dist/flatpickr.min');


//custom js file
require('../../assets/js/artisao');

require('../../assets/js/main');
require('../../assets/js/admin/dashboard');
require('../../assets/js/admin/paymentGraph');
require('../../assets/js/pages/massages');
require('../../assets/js/pages/massage_desc');
require('../../assets/js/user/user_dashboard');
require('../../assets/js/pages/animate');
require('../../assets/js/pages/bookings');
require('../../assets/js/pages/cart');
require('../../assets/js/pages/login');-
require('../../assets/js/pages/register');
require('../../assets/js/pages/contact_us');
require('../../assets/js/pages/card');
require('../../assets/js/pages/about_us');


require('../../assets/js/init');

