/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import VueTheMask from "vue-the-mask";
window.Vue.use(VueTheMask);

window.events = new Vue();

window.flash = function(message, level = "success") {
    window.events.$emit("flash", { message, level });
};

window.swal = require("sweetalert2");

window.moment = require("moment");

window.Chart = require("chart.js");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Addresses
Vue.component(
    "create-update-address-component",
    require("./components/Addresses/CreateUpdate.vue").default
);

// Co-Patrons
Vue.component(
    "create-update-copatron-component",
    require("./components/Copatrons/CreateUpdate.vue").default
);

// Patrons
Vue.component(
    "create-update-patron-component",
    require("./components/Patrons/CreateUpdate.vue").default
);
Vue.component(
    "index-patron-component",
    require("./components/Patrons/Index.vue").default
);
Vue.component(
    "modal-patron",
    require("./components/Patrons/Modal.vue").default
);
Vue.component(
    "profile-patron-component",
    require("./components/Patrons/Profile.vue").default
);

// Secretaries
Vue.component(
    "create-update-secretary-component",
    require("./components/Secretaries/CreateUpdate.vue").default
);

// Sponsors
Vue.component(
    "create-update-sponsor-component",
    require("./components/Sponsors/CreateUpdate.vue").default
);

// Utilities
Vue.component("flash", require("./components/Utilities/Flash.vue").default);
Vue.component(
    "add-remove-buttons",
    require("./components/Utilities/AddRemoveButtons.vue").default
);
Vue.component(
    "add-component",
    require("./components/Utilities/AddComponent.vue").default
);
Vue.component(
    "chart-bar",
    require("./components/Utilities/ChartBar.vue").default
);
Vue.component(
    "chart-pie",
    require("./components/Utilities/ChartPie.vue").default
);
Vue.component(
    "submit-button",
    require("./components/Utilities/SubmitButton.vue").default
);
Vue.component("croppie", require("./components/Utilities/Croppie.vue").default);
Vue.component("phone", require("./components/Utilities/Phone.vue").default);
Vue.component("general", require("./components/Utilities/General.vue").default);

Vue.component("multiselect", require("vue-multiselect").default);
require("vue-multiselect/dist/vue-multiselect.min.css");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});
