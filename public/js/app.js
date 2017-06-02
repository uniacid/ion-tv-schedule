// import Datepicker from './components/Datepicker.vue';

Vue.prototype.$http = axios;

new Vue ({
    el: '#app',

    data: {
        skills: []
    },

    mounted() {
        // make ajax reqeust /skills
        this.$http.get('/skills').then(response => this.skills = response.data);
    }
});