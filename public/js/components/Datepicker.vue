<template>
    <div>
        <datepicker v-model="date"></datepicker>
    </div>
</template>

<script>
    import datepicker from 'vue-date'
    export default {
        data() {
            return {
                date: '2016-10-16'
            }
        },
        components: { datepicker }
    }
</script>