<?php

include 'includes/acf-score.php';
include 'includes/contact-form-7.php';
//include 'includes/custom-post-type-archive-only.php';
include 'includes/custom-post-types.php';
//include 'includes/custom-taxonomy.php';
include 'includes/images.php';
include 'includes/login-screen.php';
//include 'includes/mailchimp.php';
//include 'includes/post-gallery.php';
include 'includes/disable-comments.php';
include 'includes/recaptcha.php';
include 'includes/required-plugins.php';
include 'includes/roles-capabilities.php';
include 'includes/version-info.php';
//include 'includes/vizien-dashboard-theme.php';

// Plugin to remove p tags from around images in content outputting and add class
function filter_ptags_on_images($content)
{
    // do a regular expression replace...
    // find all p tags that have just
    // <p>maybe some white space<img all stuff up to /> then maybe whitespace </p>
    // replace it with just the image tag...
    $no_p = preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
    return preg_replace('/<img(.*?)class=\"(.*?)\"(.*?)>/i', '<img$1class="$2 img-content "$3>', $no_p);
}
add_filter('the_content', 'filter_ptags_on_images');

// Set theme width
global $content_width;
$content_width = 1920;

// Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );

// Enable native lazy loading in the browser
add_filter('the_content','lazyIMG');
function lazyIMG($content) {
    $content = str_replace('<img','<img loading="lazy"', $content);
    return $content;
}

/*
 * Remove a link from the Yoast SEO breadcrumbs
 * Credit: https://timersys.com/remove-link-yoast-breadcrumbs/
 * Last Tested: Mar 12 2017 using Yoast SEO 4.4 on WordPress 4.7.3
 * GitHub: https://gist.github.com/amboutwe/4b7a2f01366399281a53c355c5b78801
 */
add_filter( 'wpseo_breadcrumb_single_link' ,'wpseo_remove_breadcrumb_link', 10 ,2);
function wpseo_remove_breadcrumb_link( $link_output , $link ){
    $text_to_remove = [
        'Rechtsgebieden',
        'Diensten',
        'Branches'
    ];
  
    if( $link['text'] == $text_to_remove ) {
      $link_output = '';
    }

    if ( in_array( $link['text'], $text_to_remove, true ) ) {
        return;
    }
 
    return $link_output;
}

// Make tables responsive
add_filter( 'the_content', 'add_custom_table_class' );
function add_custom_table_class( $content ) {
    return str_replace( '<table>', '<table class="table table-responsive">', $content );
}

// Set number of posts to display per post type
function set_posts_per_page( $query ){

    // Check if blog index page
    if( ! is_admin()
        && $query->is_home()
        && $query->is_main_query() ){
            $query->set( 'posts_per_page', -1 );
    }

    // Check if archive = custom post type
    // if( ! is_admin()
    //     && $query->is_post_type_archive( 'referenties' )
    //     && $query->is_main_query() ){
    //         $query->set( 'posts_per_page', -1 );
    // }

    // Check if archive = medewerkers
    // if( ! is_admin()
    //     && $query->is_post_type_archive( 'medewerkers' )
    //     && $query->is_main_query() ){
    //         $query->set( 'posts_per_page', -1 );
    // }
}
add_action( 'pre_get_posts', 'set_posts_per_page' );

// Set proper current_page_parent class to active parent item
function custom_active_item_classes($classes = array(), $menu_item = false){            
        global $post;
        if ($post){
            $classes[] = ($menu_item->url == get_post_type_archive_link($post->post_type)) ? 'current-menu-item active' : '';
        }
        return $classes;
    }
add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );

// Add class to next/prev pagination links
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="cta"';
}

/**
 * Enables Wordpress to upload SVG images
 *
 * @link https://css-tricks.com/snippets/wordpress/allow-svg-through-wordpress-media-uploader/
 */
// function cc_mime_types($mimes) {
//     $mimes['svg'] = 'image/svg+xml';
//     return $mimes;
// }
// add_filter('upload_mimes', 'cc_mime_types');

// Remove draft & pending pages from menu
function remove_draft_pages_from_menu ($items, $args) {
    foreach ($items as $ix => $obj) {
        if ('draft' == get_post_status ($obj->object_id) ||  'pending' == get_post_status ($obj->object_id)) {
            unset ($items[$ix]);
        }
    }
    return $items;
}
add_filter ('wp_nav_menu_objects', 'remove_draft_pages_from_menu', 10, 2); 

// Remove Emoji
function disable_wp_emojicons() {

  // All actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // Filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
  add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

// Remove comments
function custom_menu_page_removing() {
    // remove_menu_page( 'edit.php' );
    remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'custom_menu_page_removing' );

// Add Theme Options Page
if( function_exists('acf_add_options_page') ) {   
    acf_add_options_page(array(
        'page_title'    => 'Thema instellingen',
        'menu_title'    => 'Thema instellingen',
        'menu_slug'     => 'thema-instellingen',
        'capability'    => 'edit_posts'
    ));
}

// Remove admin bar
add_filter('show_admin_bar', '__return_false');

// Remove WordPress version
function remove_version(){
    return '';
}
add_filter('the_generator','remove_version');

// Blankslate
add_action('after_setup_theme', 'blankslate_setup');
    function blankslate_setup() {
        load_theme_textdomain('blankslate', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        global $content_width;
        if ( ! isset( $content_width ) ) $content_width = 640;
            register_nav_menus(
            array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
        );
    }

add_action('wp_enqueue_scripts', 'blankslate_load_scripts');
    function blankslate_load_scripts() {
        wp_enqueue_script('jquery');
    }

add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
    function blankslate_enqueue_comment_reply_script() {
        if (get_option('thread_comments')) { wp_enqueue_script('comment-reply'); }
    }

add_filter('the_title', 'blankslate_title');
    function blankslate_title($title) {
        if ($title == '') {
            return '&rarr;';
        } else {
        return $title;
    }
}
add_filter('wp_title', 'blankslate_filter_wp_title');
    function blankslate_filter_wp_title($title) {
    return $title . esc_attr(get_bloginfo('name'));
    }

add_action('widgets_init', 'blankslate_widgets_init');

function blankslate_widgets_init() {
    register_sidebar( array (
        'name' => __('Sidebar', 'blankslate'),
        'id' => 'sidebar',
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget' => '</div>',
        //'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        //'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );    
}

function blankslate_custom_pings($comment) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php 
}
add_filter('get_comments_number', 'blankslate_comments_number');

function blankslate_comments_number($count) {
    if (!is_admin()) {
        global $id;
        $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
        return count($comments_by_type['comment']);
    } else {
    return $count;
    }
}

// Set default image link option to NONE
update_option('image_default_link_type','none');

// Add to admin_init function
// add_filter('manage_testimonial_posts_columns', 'add_testimonial_columns');
// function add_testimonial_columns($columns) {
//     return array(
//         'title' => __('Title'),
//         // 'excerpt' => __('Excerpt'),
//         'date' => __('Date')
//     );
// }
// add_filter('manage_medewerkers_posts_columns', 'add_medewerkers_columns');
// function add_medewerkers_columns($columns) {
//     return array(
//         'title' => __('Title'),
//         // 'thumbnail' => __('Thumbnail'),
//         // 'excerpt' => __('Excerpt'),
//         'date' => __('Date')
//     );
// }

// Excerpt
function new_excerpt_more( $more ) {
	return ' [...]';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Excerpt length
function custom_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Use default gallery
add_filter( 'use_default_gallery_style', '__return_false' );
// add_filter( 'the_content', 'remove_br_gallery', 11, 2);
function remove_br_gallery($output) {
    return preg_replace('/\<br[^\>]*\>/','',$output);
}

// Gallery
add_filter( 'post_gallery', 'my_post_gallery', 10, 2 );
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'div',
        'icontag'    => 'div',
        'captiontag' => 'div',
        'columns'    => 3,
        'size'       => 'large',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $output = "<div id='$selector' class='gallery galleryid-{$id}'><div class='row'>";

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $i++;
        $bigImg = wp_get_attachment_image_src($id, "groot")[0];
        $alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true);
        $link = '<a data-fancybox="gallery" href="'.$bigImg.'"><img src="'.$bigImg.'" alt="'.$alt.'"></a>';

        $output .= "<{$itemtag} class='gallery-item col-sm-6 col-lg-4'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";

        $output .= "</{$itemtag}>";

        // if ($columns == $i) {
        //     $output .= '</div><div class="row">';
        //     $i = 0;
        // }
    }

    $output .= "</div></div>";

    return $output;
}

// Wrap div around YouTube videos and embeds
add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;
function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="video-container">'.$html.'</div>';
    return $return;
}

// SSL
add_action( 'plugins_loaded', 'backwpup_disable_local_ssl_verify', 11 );
function backwpup_disable_local_ssl_verify() {
    add_filter( 'https_local_ssl_verify', '__return_false' );
}