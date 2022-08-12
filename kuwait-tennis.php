<?php



/**

 * Plugin Name: kuwait-tennis

 * Plugin URI: https://www.kwt-tennis-academy.com

 * Description: Plugin Booking tennis cours.

 * Version: 0.1

 * Author: Iheb

 * Author URI: https://www.facebook.com/iheb.grayaa.01/

 **/

if (!defined('KWT_PLUGIN_FILE')) {
  define('KWT_PLUGIN_FILE', __FILE__);
}

add_role('coach', 'Coach', array('read' => true, 'edit_posts' => false, 'delete_posts' => false, 'level_0' => true));
include_once dirname(KWT_PLUGIN_FILE) . '/inc/programs-post_type.php';
include_once dirname(KWT_PLUGIN_FILE) . '/inc/programs_subscribe-post_type.php';
include_once dirname(KWT_PLUGIN_FILE) . '/inc/taxonomy-levels.php';
include_once dirname(KWT_PLUGIN_FILE) . '/inc/taxonomy-groups.php';
include_once dirname(KWT_PLUGIN_FILE) . '/inc/taxonomy-programs_type.php';
require_once dirname(KWT_PLUGIN_FILE) . '/class/class_subscribe_form.php';


function KWT_admin_assets()
{
  wp_enqueue_style('admin_css', plugin_dir_url(KWT_PLUGIN_FILE) . '/css/KWTstyle.css', false);
  wp_enqueue_style('admin_calendar_css', plugin_dir_url(KWT_PLUGIN_FILE) . '/calendar/lib/main.css', false);
  wp_enqueue_script('admin_calendar_script', plugin_dir_url(KWT_PLUGIN_FILE) . '/calendar/lib/main.js', false);
  wp_enqueue_script('KWT_script', plugin_dir_url(KWT_PLUGIN_FILE) . '/js/KWTscript.js', false);
  wp_localize_script('KWT_script', 'KWT_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
  wp_enqueue_script('jquery-ui-dialog');
  wp_enqueue_style('wp-jquery-ui-dialog');
}
add_action('admin_enqueue_scripts', 'KWT_admin_assets');


function KWT_assets()
{
  wp_enqueue_script('KWT_front_script', plugin_dir_url(KWT_PLUGIN_FILE) . '/js/app.js', false);
  wp_localize_script('KWT_front_script', 'KWT_front_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
  wp_enqueue_script('KWT_age_script', plugin_dir_url(KWT_PLUGIN_FILE) . '/js/get_posts_by_age_script.js', false);
  wp_localize_script('KWT_age_script', 'KWT_age_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
  wp_enqueue_style('kwt_front_css', plugin_dir_url(KWT_PLUGIN_FILE) . '/css/KWT-front-style.css', false);
}
add_action('wp_enqueue_scripts', 'KWT_assets');


function KWT_template($template)
{
  global $post;
  if (is_archive() && get_post_type($post) == 'programs') {
    $template = WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)) . '/templates/programs-archive.php';
  }
  if (is_single() && get_post_type($post) == 'programs') {
    $template = WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)) . '/templates/single-programs.php';
  }
  return $template;
}
add_filter('template_include', 'KWT_template');


function kuwait_menu_pages()
{
  add_menu_page('Kuwait Tennis', 'Kuwait Tennis', 'manage_options', 'kuwait-tennis', 'kuwait_calendar_output');
  add_submenu_page('kuwait-tennis', 'Programs', 'Programs', 'manage_options', 'edit.php?post_type=programs');
  add_submenu_page('kuwait-tennis', 'Levels', 'Levels', 'manage_options', 'edit-tags.php?taxonomy=levels');
  add_submenu_page('kuwait-tennis', 'Groups', 'Groups', 'manage_options', 'edit-tags.php?taxonomy=groups');
  add_submenu_page('kuwait-tennis', 'Types', 'Types', 'manage_options', 'edit-tags.php?taxonomy=programs_type');
  add_submenu_page('kuwait-tennis', 'Subscribers', 'Subscribers', 'manage_options', 'edit.php?post_type=programs_subscribe');
  add_submenu_page('kuwait-tennis', 'Calender', 'Calender', 'manage_options', 'calendar',  'kuwait_calendar_output');
}
add_action('admin_menu', 'kuwait_menu_pages');


function prefix_highlight_taxonomy_parent_menu($parent_file)
{
  if (get_current_screen()->taxonomy == 'levels' || get_current_screen()->taxonomy == 'groups' || get_current_screen()->taxonomy == 'programs_type') {
    $parent_file = 'kuwait-tennis';
  }

  return $parent_file;
}
add_action('parent_file', 'prefix_highlight_taxonomy_parent_menu');


function programs_ajax()
{
  $args = array(
    'post_type' => 'programs',
    'post_status' => 'publish',
    'posts_per_page' => -1
  );
  $posts = get_posts($args);
  foreach ($posts as $post) {
    $ID = $post->ID;
    $title = $post->post_title;
    $dateStart = get_field('date_start', $ID);
    $dateEnd = get_field('date_end', $ID);
    $day = get_field('day', $ID);
    $startTime = get_field('start_time', $ID);
    $endtTime = get_field('end_time', $ID);
    $bookStart = DateTime::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
    $bookEnd = DateTime::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
    $color = get_field('agenda_color', $ID);
    $coach = get_userdata(get_field('coach', $ID));
    $coachName = $coach->user_login;
    $groups = get_the_terms($ID, 'groups');
    $levels = get_the_terms($ID, 'levels');
    $placeNumber = get_field('place_number', $ID);
    $map = get_field('map', $ID);
    $data[] = [
      "day" => $day,
      "start_time" => $startTime,
      "end_time" => $endtTime,
      "date_start" => $bookStart,
      "date_end" => $bookEnd,
      "color" => $color,
      "title" => $title,
      "coach"  => $coachName,
      "groups" => $groups,
      "levels" => $levels,
      "place_number" => $placeNumber,
      "map" => $map
    ];
  }
  echo json_encode($data);
  wp_die();
}
add_action('wp_ajax_nopriv_programs_ajax', 'programs_ajax');
add_action('wp_ajax_programs_ajax', 'programs_ajax');


function get_posts_by_age()
{
  $currentTermId = $_GET['currentTermId'];
  $user_age = $_GET['user_age'];
  $groups = get_terms([
    'taxonomy' => 'groups',
    'hide_empty' => false
  ]);

  foreach ($groups as $group) {
    $age_min = get_field('age_min',  $group->taxonomy . '_' . $group->term_id);
    $age_max = get_field('age_max',  $group->taxonomy . '_' . $group->term_id);
    if ($user_age >= $age_min and $user_age <= $age_max) {
      $args = array(
        'post_type' => 'programs',
        'relation' => 'AND',
        'tax_query' => array(
          array(
            'taxonomy' => 'groups',
            'field' => 'term_id',
            'terms' => $group->term_id
          ),
          array(
            'taxonomy' => 'programs_type',
            'field' => 'term_id',
            'terms' => $currentTermId,
          )
        )
      );
      $posts = get_posts($args);
      foreach ($posts as $post) {
        $data_post[] = [
          "post_id" => $post->ID,
          "post_title" => $post->post_title
        ];
      }
    }
  };
  echo json_encode($data_post);
  wp_die();
}
add_action('wp_ajax_nopriv_get_posts_by_age', 'get_posts_by_age');
add_action('wp_ajax_get_posts_by_age', 'get_posts_by_age');


function get_posts_by_term()
{
  $currentTermId = $_GET['currentTermId'];
  $programsPosts = get_posts(array(
    'post_type' => 'programs',
    'numberposts' => -1,
    'tax_query' => array(
      array(
        'taxonomy' => 'programs_type',
        'field' => 'term_id',
        'terms' => $currentTermId,
      )
    )
  ));
  foreach ($programsPosts as $programPost) {
    $program_post[] = [
      "post_id" => $programPost->ID,
      "post_title" => $programPost->post_title,
    ];
  };
  echo json_encode($program_post);

  wp_die();
}
add_action('wp_ajax_nopriv_get_posts_by_term', 'get_posts_by_term');
add_action('wp_ajax_get_posts_by_term', 'get_posts_by_term');

function get_subscribe_product()
{
  $programID = $_GET['programID'];
  $programTitle = $_GET['programTitle'];
  $product = get_field('product', $programID);
  $productID = [
    "id" => $product,
    "programTitle" => $programTitle,
    "program_id" => $programID
  ];
  echo json_encode($productID);
  wp_die();
}
add_action('wp_ajax_nopriv_get_subscribe_product', 'get_subscribe_product');
add_action('wp_ajax_get_subscribe_product', 'get_subscribe_product');

function kuwait_calendar_output()
{
?>
  <div id='calendar'></div>
  <div id="eventModal" class="hidden" style="max-width:800px">
    <div class="event-title">
      <h3>Dialog content</h3>
    </div>

    <div class="event-body">
      <div class="info">
        <h4> Place number :</h4>
        <label id="placeNumber"></label>
      </div>
      <div class="info">
        <h4> Coach :</h4>
        <label id="coachName"></label>
      </div>
      <div class="info">
        <h4> Group :</h4>
        <label id="groupName"></label>
      </div>
      <div class="info">
        <h4>Level:</h4>
        <label id="levelsName"></label>
      </div>
      <div class="info">
        <h4>Time:</h4>
        <label id="time"></label>
      </div>
    </div>

  </div>

<?php }
