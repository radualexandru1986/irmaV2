require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex';
import rootStore from './store/rootStore'

//creating the store
Vue.use(Vuex);
const store = new Vuex.Store(rootStore)
// -------------------------------------------
Vue.component('users-crud', require('./components/users/CrudComponent.vue').default);
const app = new Vue({
    el: '#app',
    store:store,
    components: {
    },
    methods : {
        exit(){
        }
    }
});
