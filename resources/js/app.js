require('./bootstrap')
import Vue from 'vue';
import HomeRoutes from './components/routes/index';
import VueProgressBar from 'vue-progressbar';
import { Form, HasError, AlertError, AlertErrors } from 'vform';
import Swal from 'sweetalert2';
import { serialize }from 'object-to-formdata';
import moment from 'moment';

import VueSkeletonLoader from 'skeleton-loader-vue';

import CustomSkeleton from "./components/main/partials/CustomSkeleton.vue";

window.serialize = serialize;
window.moment = moment;


Vue.component('skeleton',VueSkeletonLoader);
Vue.component("custom-skeleton",CustomSkeleton);


window.Swal = Swal;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component(AlertErrors.name, AlertErrors);

window.Form = Form;

Vue.component("pagination",require("laravel-vue-pagination"));

Vue.use(VueProgressBar, {
    color: 'rgb(55, 161, 237)',
    failedColor: 'red',
    thickness:'5px'
  });

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

HomeRoutes.beforeEach((to,from,next)=>{
    document.title = to.meta.title || "Home";
    Vue.prototype.$Progress.start();
    next();
});
HomeRoutes.afterEach(()=>{
    Vue.prototype.$Progress.finish();
});



// Home Page Global
Vue.component('app-header',require('./components/main/partials/Header.vue').default);
Vue.component('app-footer',require('./components/main/partials/Footer.vue').default);
Vue.component("app-settingbar",require("./components/main/partials/SettingSidebar.vue").default);
// 


// Admin Page Global
Vue.component("admin-header",require("./components/admin/partials/Header.vue").default);
Vue.component("admin-footer",require("./components/admin/partials/Footer.vue").default);
Vue.component("admin-sidenav",require("./components/admin/partials/Sidenav.vue").default);
// 



const app = new Vue({
    el: '#app',
    router:HomeRoutes
});

import AdminRoutes from './components/routes/admin';


AdminRoutes.beforeEach((to,from,next)=>{
    document.title = to.meta.title || "Easin Sazzad";
    Vue.prototype.$Progress.start();
    next();
});
AdminRoutes.afterEach(()=>{
    Vue.prototype.$Progress.finish();
});


const admin = new Vue({
    el: "#admin",
    router: AdminRoutes
});
