<?PHP

get_header();

$imgUrl = get_the_post_thumbnail_url($post->ID, 'post-thumbnail');

$groups = get_the_terms($post->ID, 'groups');
global $post;

?>

<article class="itemscope post_item post_item_single post_featured_center post_format_standard post-<?php echo get_the_ID() ?> services type-services status-publish has-post-thumbnail hentry services_group-welcome" itemscope="" itemtype="//schema.org/Article">

    <section class="post_featured">

        <div class="post_thumb" data-image="<?php echo $imgUrl ?>" data-title="<?php echo $post->post_title ?>">

            <a class="hover_icon hover_icon_view inited" href="<?php echo $imgUrl ?>" title="<?php echo $post->post_title ?>" rel="magnific"><img class="wp-post-image" alt="<?php echo $post->post_title ?>" src="<?php echo $imgUrl ?>" itemprop="image" width="1170" height="659"></a>

        </div>

    </section>

    <section class="post_content" itemprop="articleBody">

        <div class="post_info">

            <span class="post_info_item post_info_posted"> <a href="<?php the_permalink(); ?>" class="post_info_date date updated" itemprop="datePublished" content="<?php echo get_the_date('o-m-d H:i:s') ?>"> <?php the_date() ?></a></span>

            <span class="post_info_item post_info_tags">in <a class="services_group_link" href="<?php echo get_term_link($groups[0]->term_id) ?>"><?php echo $groups[0]->name ?></a></span>

            <span class="post_info_item post_info_counters"> <a class="post_counters_item post_counters_comments icon-commenting" title="Comments - <?php echo get_comments_number($post->ID) ?>" href="<?php echo get_permalink() . '#respond' ?>"><span class="post_counters_number"><?php echo get_comments_number($post->ID) ?></span></a>

            </span>

        </div>

    </section>

    <section class="user-registartion">
        <?php
        $currentTerm = get_the_terms($post->ID, 'programs_type');
        ?>
        <input type="hidden" value="<?php echo $currentTerm[0]->name; ?>" class="currentTerm" id="currentTerm" />
        <input type="hidden" name="currentTermId" value="<?php echo $currentTerm[0]->term_id; ?>" class="currentTermId" id="currentTermId" />
        <?php
        // echo do_shortcode('[user_registration_form id="1285"]');

        // echo do_shortcode('[contact-form-7 id="1292" title="Subscription"]');
        ?>
        <form id="subscriber_form" name="subscriber_form" action="<?php echo esc_url( get_permalink() ); ?>" method="POST">
            <div class="kwt_form_subscribe">
                <div class="item_sub">
                    <label class="input_title" for="fullname"><?php echo esc_html('Full Name') ;?><span class="kwt_required">*</span></label>
                    <div class="kwt_input">
                        <input type="text" id="fullname" name="user_fullname" required minlength="4">
                    </div>
                </div>

                <div class="item_sub">
                    <label class="input_title" for="email"><?php echo esc_html('Email') ?><span class="kwt_required">*</span></label>
                    <div class="kwt_input">
                        <input type="email" id="email" name="user_email" required>
                    </div>
                </div>

                <div class="item_sub">
                    <label class="input_title" for="user_phone"><?php echo esc_html('Phone') ?><span class="kwt_required">*</span></label>
                    <div class="kwt_input">
                        <input data-rules="" data-inputmask="'mask':'(999) 999-9999'" data-id="user_phone" type="tel" value="" class=" ur-frontend-field  ur-masked-input" name="user_phone" id="user_phone" required="required" data-label="Phone">
                    </div>
                </div>

                <div class="item_sub">
                    <label class="input_title" for="user_age"><?php echo esc_html('Age') ?><span class="kwt_required">*</span></label>
                    <div class="kwt_input">
                        <input type="number" id="user_age" name="user_age" min="0" max="100" required>
                    </div>
                </div>
                <div class="item_sub">
                    <label class="input_title program_title" for="program_list">Ladies Tennis Programs<span class="kwt_required">*</span></label>
                    <div class="kwt_input">
                        <?php
                        $args = array(
                            'post_type' => 'programs',
                            'post_status' => 'publish',
                            'posts_per_page' => -1
                        );
                        $posts = get_posts($args);
                        ?>
                        <select name="program_list" id="program_list" required>
                            <?php foreach ($posts as $post) { ?>
                                <option value="<= $post->ID ?>"><?= $post->post_title ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="product_id" id="productID" value=""/>
                        <input type="hidden" name="program_title" id="program_title" value=""/>
                        <input type="hidden" name="program_id" id="program_id" value=""/>
                    </div>
                </div>

                <div class="item_sub btn-sub">
                    <button name="subscriber_form_submit" type="submit" class="btn-submit"><?php echo esc_html('Book now') ?> </button>
                </div>
            </div>
        </form>
    </section>

</article>
<?PHP

get_footer();
