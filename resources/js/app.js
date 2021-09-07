require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex';
import rootStore from './store/rootStore'

//creating the store
Vue.use(Vuex);
const store = new Vuex.Store(rootStore)
// -------------------------------------------

import Admin from './components/admin/Main.component';
import User from './components/user/Main.component'
const app = new Vue({
    el: '#app',
    store:store,
    components: {
        admin: Admin,
        user: User
    }
});
