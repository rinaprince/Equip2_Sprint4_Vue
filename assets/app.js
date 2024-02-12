import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import '@popperjs/core';
import 'bootstrap-icons/font/bootstrap-icons.css';
import '@fortawesome/fontawesome-free/css/all.css';
import 'jquery';
import 'datatables.net-dt/js/dataTables.dataTables';
import 'datatables.net-dt/css/jquery.dataTables.css';
import 'quill/dist/quill.snow.css';

import './equip3/css/variables.css';
import './equip3/css/modal.css';
import './equip3/css/backend-skeleton.css';
import './equip3/css/cataleg.css';
import './equip3/css/providers.css';
import './equip3/js/menu-burguer';
import './equip3/js/menu_aside';
import './equip3/js/modal';



import { registerVueControllerComponents } from '@symfony/ux-vue';

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));