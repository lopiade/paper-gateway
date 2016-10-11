import Vue from 'vue';
import VueResource from 'vue-resource';

import PaperResources from './components/PaperResources';

window.Vue = Vue;
Vue.use(VueResource);


Vue.config.delimiters = ['[[', ']]'];

Vue.config.debug = true; // turn on debugging mode
Vue.config.silent = false; // turn on silent mode
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

/**
 * Main App instance!
 *
 * @type {Vue}
 */
new Vue({

    name: 'PaperGateway',

    el: '#app',

    components: {

        PaperResources

    },

    ready() {

    }

});