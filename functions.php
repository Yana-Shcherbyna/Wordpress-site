<?php

if (!function_exists('theme_name_setup')) {
    function theme_name_setup()
    {
        // add background
        $defaults = array(
            'default-image'          => get_template_directory_uri() . '/i/intro-bg.jpg',
            'wp-head-callback'       => '_intro_mod_section_custom_background_cb',
        );

        add_theme_support('custom-background', $defaults);
        add_theme_support('post-thumbnails');
    }
    add_action('after_setup_theme', 'theme_name_setup');
}

// add styles and scripts
add_action('wp_enqueue_scripts', 'theme_name_scripts');

function theme_name_scripts()
{
    // add styles and scripts from head
    wp_enqueue_style('style', get_template_directory_uri() . '/styles/main_global.css');

     // підключення font-awesome через cdn (НЕ ДОПОМОГЛО)**********************
    // wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css');

    wp_enqueue_script('font', get_template_directory_uri() . '/js/font-loader.js');
    // deregister the built-in "jquery" library
    wp_deregister_script('jquery');
    // register "jquery" library 
    wp_register_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js');
    // add scripts from footer
    wp_enqueue_script('jquery');
    wp_enqueue_script('all', get_template_directory_uri() . '/js/all.js', array('jquery'), 'null', true);
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), 'null', true);
}

function mo_go_setup()
{
    // register nav_menu
    register_nav_menus(
        array(
            'header' => esc_html__('Primary menu', 'mo_go_menu')
        )
    );
}

// add class header_nav_menu
add_filter('nav_menu_css_class', 'custom_nav_menu_css_class', 10, 1);

function custom_nav_menu_css_class($classes)
{
    $classes[] = 'header_menu_item';
    return $classes;
}

// add class to attributes <a> header_nav_menu
add_filter('nav_menu_link_attributes', 'custom_nav_menu_link_attributes', 10);

function custom_nav_menu_link_attributes($atts)
{
    $atts['class'] = 'header_menu_link';
    return $atts;
}
add_action('after_setup_theme', 'mo_go_setup');

// add custom post type for 'Team' section
function team_wporg_custom_post_type()
{
    register_post_type(
        'Team',
        array(
            'labels'      => array(
                'name'          => __('Team', 'textdomain'),
                'singular_name' => __('Teamember', 'textdomain'),
            ),
            'public'        => true,
            'has_archive'   => true,
            'menu_position' => 4,
            'supports'      => ['title', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
            'hierarchical'  => true,
        )
    );
}
add_action('init', 'team_wporg_custom_post_type');

// add custom post type for 'Testimonials' section
function testimonials_wporg_custom_post_type()
{
    register_post_type(
        'Testimonials',
        array(
            'labels'      => array(
                'name'          => __('Testimonials', 'textdomain'),
                'singular_name' => __('Testimonial', 'textdomain'),
            ),
            'public'        => true,
            'has_archive'   => true,
            'menu_position' => 4,
            'supports'      => ['title', 'editor', 'thumbnail', 'custom-fields'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
            'hierarchical'  => true,
        )
    );
}
add_action('init', 'testimonials_wporg_custom_post_type');

//add a plugin for the ability to display the number of post views
// ounting the number of page visits
add_action('wp_head', 'kama_postviews');

/**
 * @param array $args
 *
 * @return null
 */
function kama_postviews($args = [])
{
    global $user_ID, $post, $wpdb;

    if (!$post || !is_singular())
        return;

    $rg = (object) wp_parse_args($args, [
        // Key of the post meta field where the number of views will be recorded.
        'meta_key' => 'views',
        // Whose visits are counted? 0 - Everyone. 1 - Guests only. 2 - Only registered users.
        'who_count' => 1,
        // Exclude bots, robots? 0 - no, let them count too. 1 - yes, exclude from counting.
        'exclude_bots' => true,
    ]);

    $do_count = false;
    switch ($rg->who_count) {

        case 0:
            $do_count = true;
            break;
        case 1:
            if (!$user_ID)
                $do_count = true;
            break;
        case 2:
            if ($user_ID)
                $do_count = true;
            break;
    }

    if ($do_count && $rg->exclude_bots) {

        $notbot = 'Mozilla|Opera'; // Chrome|Safari|Firefox|Netscape - everyone is equal Mozilla
        $bot = 'Bot/|robot|Slurp/|yahoo';
        if (
            !preg_match("/$notbot/i", $_SERVER['HTTP_USER_AGENT']) ||
            preg_match("~$bot~i", $_SERVER['HTTP_USER_AGENT'])
        ) {
            $do_count = false;
        }
    }

    if ($do_count) {

        $up = $wpdb->query($wpdb->prepare(
            "UPDATE $wpdb->postmeta SET meta_value = (meta_value+1) WHERE post_id = %d AND meta_key = %s",
            $post->ID,
            $rg->meta_key
        ));

        if (!$up) {
            add_post_meta($post->ID, $rg->meta_key, 1, true);
        }

        wp_cache_delete($post->ID, 'post_meta');
    }
}


// Custom functions
function get_service_icon_class($icon_class)
{
    switch ($icon_class) {
            // classes for service and accordion section section
        case 'photo_mod':
            return 'photo_mod';
        case 'design_mod':
            return 'design_mod';
        case 'digit_mod':
            return 'digit_mod';
        case 'html_mod':
            return 'html_mod';
        case 'comp_mod':
            return 'comp_mod';
        case 'seo_mod':
            return 'seo_mod';
        case 'creative_mod':
            return 'creative_mod';
            // classes for team section
        case 'facebook_mod':
            return 'facebook_mod';
        case 'google-plus_mod':
            return 'google-plus_mod';
        case 'instagram_mod':
            return 'instagram_mod';
        case 'pinterest_mod':
            return 'pinterest_mod';
        case 'twitter_mod':
            return 'twitter_mod';
    }
}