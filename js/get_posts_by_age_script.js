jQuery(document).ready(function ($) {

    $('#user_age').on('change', function (e) {
        e.preventDefault();
        var user_age = $('#user_age').val();
        var currentTermId = jQuery('#currentTermId').val();
        jQuery.ajax({

            type: "get",

            dataType: "json",

            url: KWT_age_ajax.ajax_url,

            data: { currentTermId: currentTermId, user_age: user_age, action: "get_posts_by_age" },

            success: function (post_data) {
                jQuery("#program_list").empty();
                jQuery.each(post_data, function (key, post) {

                    var option = '<option value="' + post.post_id + '">' + post.post_title + '</option>';

                    jQuery("#program_list").append(option);
                })
            }
        })
    });

    $('#program_list').on('change', function () {
        var programID = $('#program_list').val();
        var programTitle = $('#program_list :selected').text();
        jQuery.ajax({

            type: "get",

            dataType: "json",

            url: KWT_age_ajax.ajax_url,

            data: {programTitle : programTitle, programID: programID, action: "get_subscribe_product" },

            success: function (post_data) {
                $('#productID').val(post_data.id);
                $('#program_title').val(post_data.programTitle);
                $('#program_id').val(post_data.program_id);
            }
        })
    });
});
