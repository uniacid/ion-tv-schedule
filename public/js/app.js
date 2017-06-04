"use strict";

Vue.prototype.$http = axios;

var fullDateToday = new Date();
var fullDateTomorrow = new Date();
var fullDateNextWeek = new Date();
var d = new Date();
fullDateTomorrow.setDate(fullDateTomorrow.getDate() + 1);
fullDateTomorrow.setHours(0, 0, 0, 0);
fullDateNextWeek.setDate(fullDateNextWeek.getDate() + 7);
var twoDigitMonth = fullDateToday.getMonth() + 1 + "";if (twoDigitMonth.length == 1) twoDigitMonth = "0" + twoDigitMonth;
var twoDigitMonthNextweek = fullDateToday.getMonth() + 1 + "";if (twoDigitMonthNextweek.length == 1) twoDigitMonthNextweek = "0" + twoDigitMonthNextweek;
var twoDigitDate = fullDateToday.getDate() + "";if (twoDigitDate.length == 1) twoDigitDate = "0" + twoDigitDate;
var twoDigitDateNextWeek = fullDateNextWeek.getDate() + "";if (twoDigitDateNextWeek.length == 1) twoDigitDateNextWeek = "0" + twoDigitDateNextWeek;
var todaysDate = fullDateToday.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDate;
var nextWeeksDate = fullDateNextWeek.getFullYear() + "-" + twoDigitMonthNextweek + "-" + twoDigitDateNextWeek;

window.app = new Vue({
    el: '#app',

    components: { datepicker: datepicker },

    data: {
        momentDateTime: null,

        momentDate: null,

        defaultDate: todaysDate,

        dateSelected: todaysDate,

        maxDate: nextWeeksDate,

        featuredShow: {},

        tvSchedule: {},

        tvScheduleSelectedDay: {},

        tvScheduleSelectedDate: '',

        showFullSynopsis: false,

        sched: '',

        t: ''
    },

    filters: {
        truncate: function truncate(string, value) {
            return string.substring(0, value) + '...';
        }
    },

    methods: {
        clear: function clear() {
            this.init = ' ';
        },
        updateEventDate: function updateEventDate(val) {
            console.log(val);
        },
        dateSelect: function dateSelect() {
            this.featuredShow = this.tvSchedule[this.dateSelected].featured;
            this.tvScheduleSelectedDay = this.tvSchedule[this.dateSelected].schedule;
        },
        fullSynopsis: function fullSynopsis(show, event) {
            this.$set(show, 'showFullSynopsis', true);
            $('.tvShow').matchHeight();
            $('html, body').animate({
                scrollTop: $(event.srcElement).offset().top - 300
            }, 1000);
            console.log('fullSynopsis');
            console.log(event);
        },
        shortSynopsis: function shortSynopsis(show, event) {
            this.$set(show, 'showFullSynopsis', false);
            $('.tvShow').matchHeight();
            $('html, body').animate({
                scrollTop: $(event.srcElement).offset().top - 300
            }, 1000);
            console.log('shortSynopsis');
            console.log(event);
        },
        addShowSynopsisVar: function addShowSynopsisVar(shows) {
            for (var show = 0; show < shows.length; show++) {
                this.$set(this.tvScheduleSelectedDay[show], 'showFullSynopsis', false);
            }
        },
        momentClock: function momentClock() {
            this.momentDate = moment(new Date());
            this.momentDateTime = this.momentDate.format('dddd, MMMM Do YYYY, h:mm:ss a');
        },
        momentMidnight: function momentMidnight() {
            setTimeout(function () {
                console.log('reloading...');
                document.location.reload(true);
            }, moment("24:00:00", "hh:mm:ss").diff(moment(), 'milliseconds'));
        }
    },

    mounted: function mounted() {
        var _this = this;

        this.momentMidnight();
        this.momentClock();
        setInterval(this.momentClock, 1000);
        // make ajax reqeust
        this.$http.get('tv-schedule').then(function (response) {
            _this.tvSchedule = response.data;

            if (_this.dateSelected) {
                _this.featuredShow = _this.tvSchedule[_this.dateSelected].featured;
                _this.tvScheduleSelectedDay = _this.tvSchedule[_this.dateSelected].schedule;
                _this.tvScheduleSelectedDate = _this.tvSchedule[_this.dateSelected].date_formatted;
                _this.addShowSynopsisVar(_this.tvScheduleSelectedDay);
            } else {
                _this.featuredShow = _this.tvSchedule[_this.defaultDate].featured;
                _this.tvScheduleSelectedDay = _this.tvSchedule[_this.defaultDate].schedule;
                _this.tvScheduleSelectedDate = _this.tvSchedule[_this.defaultDate].date_formatted;
                _this.addShowSynopsisVar(_this.tvScheduleSelectedDay);
            }

            setTimeout(function () {
                $('.tvShow').matchHeight();
            }, 2000);
        });
    }
});