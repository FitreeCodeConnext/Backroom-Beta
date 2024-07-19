import './bootstrap';
import 'flowbite';



import VueApexCharts from 'vue-apexcharts';
Vue.component('apexchart', VueApexCharts);

const app = new Vue({
    el: '#app',
});
export default app;

import Datepicker from "flowbite-datepicker/Datepicker";
import th from "/node_modules/flowbite-datepicker/js/i18n/locales/th.js";

const datepickerEl = document.getElementById('datepickerId');
Datepicker.locales.th = th.th;
new Datepicker(datepickerEl, {
   language: 'th',
   format: 'dd/mm/yyyy'
});