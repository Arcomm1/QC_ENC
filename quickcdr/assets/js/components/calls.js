var calls = new Vue({

    el: '#calls',
    data () {
        return {
            language: user_language,
            start_page: user_start_page,
        }
    },

    methods: {

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

        load_player: function(uniqueid) {
            console.log(uniqueid);
            console.log(app_url+'/calls/get_file/'+uniqueid)
            $(document).ready(function(){
                p = $("#jquery_jplayer_1").jPlayer({
                    ready: function () {
                    },
                    cssSelectorAncestor: "#jp_container_1",
                    swfPath: "/js",
                    supplied: "m4a, oga, wav",
                    useStateClassSkin: true,
                    autoBlur: false,
                    smoothPlayBar: true,
                    keyEnabled: true,
                    remainingDuration: false,
                    toggleDuration: false
                });
                p.jPlayer("setMedia", {wav: app_url+'/calls/get_file/'+uniqueid})
            });
        },

    },

});


$('#calldate_gt').datetimepicker({format: 'Y-m-d H:i:00'});
$('#calldate_lt').datetimepicker({format: 'Y-m-d H:i:00'});
$('#nav-calls').addClass('active');

$('#play_recording').on('hidden.bs.modal', function() {
    console.log("destroying player");
    $("#jquery_jplayer_1").jPlayer("destroy");
})