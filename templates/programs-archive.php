<?PHP
get_header();
// var_dump($posts);
foreach ($posts as $post) {
    $imgUrl = get_the_post_thumbnail_url($post->ID,'post-thumbnail');
    echo $post->post_title . '<br>';
    echo '<img src="'. $imgUrl.'"> <br>';
}
get_footer();