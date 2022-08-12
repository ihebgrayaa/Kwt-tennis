jQuery(document).ready(function () {

    (function (jQuery) {
        var currentTerm = jQuery('#currentTerm').val();
        var currentTermId = jQuery('#currentTermId').val();
        if (currentTerm == 'Paddle') {
            jQuery('.kwt_form_subscribe .program_title').html('Paddle subscription program <abbr class="required" title="required">*</abbr>');
            // jQuery('.program_list .ur-label').attr('for', 'Paddle subscription program');
        };
        if (currentTerm === 'Tennis') {
            jQuery('.kwt_form_subscribe .program_title').html('Tennis subscription program <abbr class="required" title="required">*</abbr>');
            // jQuery('.program_list .ur-label').attr('for', 'Tennis subscription program');
        };
        jQuery.ajax({

            type: "get",

            dataType: "json",

            url: KWT_front_ajax.ajax_url,

            data: {currentTermId : currentTermId , action: "get_posts_by_term" },

            success: function (posts) {
                jQuery("#program_list").empty()
                jQuery.each(posts, function (key, post) {

                    var option = '<option value="'+post.post_id+'">'+post.post_title+'</option>' ;
                    
                    jQuery("#program_list").append(option);
                })
            }
        })
    })(jQuery);
});