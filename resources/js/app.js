require('./bootstrap');
import $ from 'jquery';
window.$ = window.jQuery = $;
require('datatables.net-bs4');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Swal = require('sweetalert2');

require('select2');