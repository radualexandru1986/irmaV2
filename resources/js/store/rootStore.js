import adminStore from '../store/modules/admin';
const rootStore = ()=>({
    state : {
    },
    mutations: {
    },
    modules: {
        admin :adminStore
    }
})

export default rootStore();
