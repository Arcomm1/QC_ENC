var stats = new Vue({

    el: '#stats',
    data () {
        return {
            by_disposition: {},
            by_disposition_loading: true,
            by_disposition_error: false,

            by_direction: {},
            by_direction_loading: true,
            by_direction_error: false,

            by_duration: {},
            by_duration_loading: true,
            by_duration_error: false,

            by_device: {},
            by_device_loading: true,
            by_device_error: false,

            chart_disposition_distrib: false,
            chart_direction_distrib: false,
            chart_duration_distrib: false,

            language: user_language,
            start_page: user_start_page,
        }
    },

    methods: {
        get_stats_by_disposition: function () {
            form_data = new FormData();
            form_data.append('calldate_gt', $('#calldate_gt').val());
            form_data.append('calldate_lt', $('#calldate_lt').val());
            axios.post(app_url+'/stats/get_by_disposition/', form_data)
                .then(
                    response => {
                        this.by_disposition = response.data.data;

                        ctx_disposition_distrib = document.getElementById("ctx_disposition_distrib").getContext('2d');
                        this.chart_disposition_distrib = new Chart(ctx_disposition_distrib, {
                            type: 'bar',
                            data: {
                                labels: [lang['ANSWERED'], lang['NO ANSWER'], lang['BUSY'], lang['FAILED']],
                                datasets: [{
                                    backgroundColor: [
                                        get_colors('success'),
                                        get_colors('danger'),
                                        get_colors('warning'),
                                        get_colors('info')
                                    ],
                                    data: [
                                        response.data.data['ANSWERED'],
                                        response.data.data['NO ANSWER'],
                                        response.data.data['BUSY'],
                                        response.data.data['FAILED'],
                                    ]
                                }]
                            },
                            options: {
                                legend: {
                                    display: false,
                                }
                            }
                        });
                    }
                )
            .finally(() => this.by_disposition_loading = false)
        },

        get_stats_by_direction: function () {
            form_data = new FormData();
            form_data.append('calldate_gt', $('#calldate_gt').val());
            form_data.append('calldate_lt', $('#calldate_lt').val());
            axios.post(app_url+'/stats/get_by_direction/', form_data)
                .then(
                    response => {
                        this.by_direction = response.data.data;

                        ctx_direction_distrib = document.getElementById("ctx_direction_distrib").getContext('2d');
                        this.chart_direction_distrib = new Chart(ctx_direction_distrib, {
                            type: 'pie',
                            data: {
                                labels: [lang['outgoing'], lang['incoming'], lang['internal']],
                                datasets: [{
                                    backgroundColor: [
                                        get_colors('success'),
                                        get_colors('primary'),
                                        get_colors('info'),
                                    ],
                                    data: [
                                        response.data.data['outgoing'],
                                        response.data.data['incoming'],
                                        response.data.data['internal'],
                                    ]
                                }]
                            },
                        });
                    }
                )
            .finally(() => this.by_direction_loading = false)
        },

        get_stats_by_duration: function () {

            form_data = new FormData();
            form_data.append('calldate_gt', $('#calldate_gt').val());
            form_data.append('calldate_lt', $('#calldate_lt').val());
            axios.post(app_url+'/stats/get_by_duration/', form_data)
                .then(
                    response => {
                        this.by_duration = response.data.data;

                        ctx_duration_distrib = document.getElementById("ctx_duration_distrib").getContext('2d');
                        this.chart_duration_distrib = new Chart(ctx_duration_distrib, {
                            type: 'pie',
                            data: {
                                labels: [lang['lt_15'], lang['lt_30'], lang['lt_60']],
                                datasets: [{
                                    backgroundColor: [
                                        get_colors('success'),
                                        get_colors('warning'),
                                        get_colors('primary'),
                                    ],
                                    data: [
                                        response.data.data['lt_15'],
                                        response.data.data['lt_30'],
                                        response.data.data['lt_60'],
                                    ]
                                }]
                            },
                            options: {
                                legend: {
                                    position: 'right',
                                    labels: {
                                        defaultFontFamily: 'Roboto',
                                    }
                                }
                            }
                        });
                    }
                )
            .finally(() => this.by_duration_loading = false)
        },

        update_settings: function () {
            console.log("Test");
            f = new FormData();
            f.append('language', $('#language').val());
            f.append('start_page', $('#start_page').val());
            console.log(f);
            axios.post(app_url+'/users/update_settings/'+user_id, f)
                .then(
                    response => {
                        if (response.data.status == 'OK') {
                            location.reload();
                        } else {
                            console.log("ERROR");
                        }
                    }
                )
        },

        refresh: function () {
            this.chart_direction_distrib.destroy();
            this.chart_disposition_distrib.destroy();
            this.chart_duration_distrib.destroy();
            this.get_stats_by_disposition();
            this.get_stats_by_direction();
            this.get_stats_by_duration();
        },

        load_data: function () {
            if (this.chart_direction_distrib.destroy === 'function') {
                console.log("Here");
                this.chart_direction_distrib.destroy()
            }
            if (this.chart_disposition_distrib.destroy === 'function') {
                console.log("Here");
                this.chart_disposition_distrib.destroy()
            }
            if (this.chart_duration_distrib.destroy === 'function') {
                console.log("Here");
                this.chart_duration_distrib.destroy() 
            }
            this.get_stats_by_disposition();
            this.get_stats_by_direction();
            this.get_stats_by_duration();
        }

    },

    created () {
        this.load_data();
    }

});


$('#calldate_gt').datetimepicker({format: 'Y-m-d H:i:00'});
$('#calldate_lt').datetimepicker({format: 'Y-m-d H:i:00'});
$('#nav-stats').addClass('active');
