/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


Vue.use(require('vue-moment'));

import { Cropper } from 'vue-advanced-cropper'

import Vuex from 'vuex'
import StoreData from './store.js'

Vue.use(Vuex)
const store = new Vuex.Store(StoreData)

import Select2 from 'v-select2-component';
Vue.component('Select2', Select2);


import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css';
Vue.component('datetime', Datetime);

import * as VueGoogleMaps from "vue2-google-maps";
Vue.use(VueGoogleMaps, {

    load: {
        //   key: "AIzaSyDZY3cXMHPDhTzmzcCy-jMRpleM8wtRDWo",
        key: "AIzaSyCxDRV5qVG64KQZSER_Bh6r2Iyg_g8km54",
        libraries: 'places',
    },

});

import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

// Vue.http.interceptors.push(function(request) {
//     let token = btoa("5a5d883cdebd4423b00c2a6a746ed77a:bf47f67b69694479be3739c5ca470c34");
//     console.log('dfada');
//     request.headers.set('Authorization', 'Basic ' + token);
// });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('register-form', require('./components/forms/register.vue').default);
Vue.component('teacher-register', require('./components/forms/teacherRegister.vue').default);
Vue.component('student-register', require('./components/forms/studentRegister.vue').default);
Vue.component('create-ad', require('./components/forms/createAd.vue').default);
Vue.component('map-input', require('./components/partials/mapInput.vue').default);
Vue.component('edit-ad', require('./components/forms/editAd.vue').default);
Vue.component('profile', require('./components/pages/user/profile.vue').default);
Vue.component('favorites', require('./components/pages/user/favorites.vue').default);
Vue.component('sessions', require('./components/pages/user/sessions.vue').default);
Vue.component('plans', require('./components/pages/user/plans.vue').default);
Vue.component('edit-profile', require('./components/forms/editProfile.vue').default);
Vue.component('book-plan', require('./components/forms/bookPlan.vue').default);
Vue.component('edit-location', require('./components/forms/editLocation.vue').default);
Vue.component('edit-plans', require('./components/forms/editPlans.vue').default);
Vue.component('edit-payment', require('./components/forms/editPayment.vue').default);
Vue.component('tutor-search', require('./components/search/tutorSearch.vue').default);
Vue.component('tutor', require('./components/search/tutor.vue').default);
Vue.component('tutor-view', require('./components/search/tutorView.vue').default);
Vue.component('ad-view', require('./components/search/adView.vue').default);
Vue.component('ads', require('./components/search/ads.vue').default);
Vue.component('ad', require('./components/search/ad.vue').default);
Vue.component('my-ads', require('./components/ad/my.vue').default);
Vue.component('change-password', require('./components/forms/changePassword.vue').default);
Vue.component('start-chat', require('./components/forms/startChat.vue').default);
Vue.component('full-loader', require('./components/spinners/fullLoader.vue').default);
Vue.component('options-dropdown', require('./components/optionsDropdown.vue').default);
Vue.component('slide-menu', require('./components/menus/slideMenu.vue').default);
Vue.component('menu-icons', require('./components/menus/menuIcons.vue').default);
Vue.component('payments-page', require('./components/pages/paymentsPage.vue').default);


Vue.component('chat-app', require('./components/chat/ChatApp.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
const navapp = new Vue({
    el: '#navapp',
    store
});
