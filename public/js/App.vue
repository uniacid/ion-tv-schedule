<script>
    import Datepicker from './components/Datepicker.vue';

    Vue.prototype.$http = axios;

    new Vue ({
        el: '#app',

        data: {
            skills: []
        },

        mounted() {
            // make ajax reqeust /skills
            // fetch()
            // $.ajax() $.getJson()
            // axios
            this.$http.get('/skills').then(response => this.skills = response.data);

            // vue resource
            // this.$http.post('/skills', [])
        }
    });
</script>