
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
Vue.component('search', require('./components/Search.vue'));
Vue.component('emissions-select', require('./components/EmissionsSelect.vue'));

import EmissionsChoices from './components/EmissionsSelectChoices'
import Axios from 'axios';

const app = new Vue({
    el: '#app',
    data () {
        return {
            emissionChoice: EmissionsChoices[0]
        }
    },
    methods : {
        updateEmission (choice) {
            this.emissionChoice = choice;
        },
        search (query) {
            axios.get('/api/search', { params : {
                q: query
            }});
        }
    }
});
