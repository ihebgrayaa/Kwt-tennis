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

        echo do_shortcode('[contact-form-7 id="1292" title="Subscription"]');
        ?>
    </section>

</article>
<?PHP

get_footer();
