/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// require('./select2.min.js');

window.Vue = require('vue').default;

import moment from 'moment';
import VueRouter from 'vue-router';
import { Form, Button, HasError, AlertError } from 'vform';
import VueProgressBar from 'vue-progressbar';
import Swal from 'sweetalert2';
import Chartkick from 'vue-chartkick';
import Chart from 'chart.js';
import DatePicker from 'vue2-datepicker';
import CKEditor from '@ckeditor/ckeditor5-vue2';
import Overlay from 'vue-loading-overlay';



import Gate from './Gate';
Vue.prototype.$gate = new Gate(window.user);

// Register Fire event globally
window.Fire = new Vue();


//  Define sweetAlert2 globally
window.swal = Swal;
const Toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,                    
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.toast = Toast;

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.use(VueRouter);
Vue.use(Chartkick.use(Chart));
Vue.use(DatePicker);
Vue.use(moment);
Vue.use( CKEditor );
Vue.use(Overlay);


// Register Global filters
Vue.filter('dateFormat', function(dateCreated) {
    return moment(dateCreated).format('MM-Do-YY h:mm');
})
Vue.filter('upText', function(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
})

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
});

let routes = [
    { path : '/admin-dashboard', component: require('./components/Dashboard.vue').default },
    { path : '/add-project', component: require('./components/MyProposals.vue').default },
    { path : '/departments', component: require('./components/Departments.vue').default },
    { path : '/bcs-dept', component: require('./components/Bcs.vue').default },
    { path : '/sik-dept', component: require('./components/Sik.vue').default },
    { path : '/ets-dept', component: require('./components/Ets.vue').default },
    { path : '/home', component: require('./components/Profile.vue').default },
    { path : '/students-list', component: require('./components/StudentAll.vue').default },
    { path : '/student-dashboard', component: require('./components/ProposalsListV2.vue').default },
    { path : '/student-supervisor-list', component: require('./components/SupervisorsAssignments.vue').default },
    { path : '/students-per-supervisor', component: require('./components/StudentsPerSupervisor.vue').default },
    { path : '/supervisors-list', component: require('./components/SupervisorsList.vue').default },
    { path : '/my-proposal-list', component: require('./components/MyProposals.vue').default },
    { path : '/proposals-list-pending', component: require('./components/ProposalsListPending.vue').default },
    { path : '/proposals-list-approved', component: require('./components/ProposalsListApproved.vue').default },
    { path : '/presentations-list', component: require('./components/PresentationList.vue').default },
    { path : '/proposals-list', component: require('./components/ProposalsListV2.vue').default },
    { path : '/new-proposal', component: require('./components/NewProposal.vue').default },
    { path : '/test', component: require('./components/Bcs.vue').default },

    // { path : '*', component: require('./components/404.vue').default },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('not-found', require('./components/404.vue').default);
Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('modalForm', require('./components/ModalForm.vue').default);
Vue.component('projectDetails', require('./components/ProjectDetails.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue').default);
Vue.component('loading-button', require('vue-loading-button/src/vue-loading-button.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data: {
        search: ''
    },
    methods: {
        searchit: _.debounce(() => {
            Fire.$emit('searching');
        }, 1000)
    }
});
