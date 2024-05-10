<?php
/*------------------------------------*\
    Globals
\*------------------------------------*/

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

require_once('inc/acf.php');
require_once('blocks/index.php');


/*------------------------------------*\
    Theme Support
\*------------------------------------*/
add_theme_support('custom-header');


/*------------------------------------*\
    Custom Gutenberg Blocks
\*------------------------------------*/
require get_template_directory() . '/gutenberg-blocks/gutenberg.php';





// Include the WP_Customize_Control class
require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

function vigorCrossfit_setup()
{

    register_nav_menus(array(
        'primary' => 'primary',
        'footer-menu' => 'Footer Menu',
    ));
}

add_action('after_setup_theme', 'vigorCrossfit_setup');

/*------------------------------------*\
    Functions
\*------------------------------------*/

// Load scripts (header.php)
function vigorCrossfit_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('vigorCrossfit', get_template_directory_uri() . '/dist/js/scripts.min.js', array('jquery'), '', true);
        wp_enqueue_script('vigorCrossfit');

        // Enqueue slideshow.js file
        wp_enqueue_script('slideshow-script', get_template_directory_uri() . '/src/scripts/block/slideshow.js', array('jquery'), '', true);
        wp_enqueue_script('slideshow-script');

        // Enqueue your custom map script
        wp_enqueue_script('custom-map-script', get_template_directory_uri() . '/src/scripts/block/map-script.js', array('jquery'), '', true);
        wp_enqueue_script('custom-map-script');

        // Enqueue your custom woocommerce script
        wp_enqueue_script('custom-woocommerce-script', get_template_directory_uri() . '/src/scripts/woocommerce/woocommerce.js', array('jquery'), '', true);
        wp_enqueue_script('custom-woocommerce-script');

        // Enqueue your custom subscribe script
        wp_enqueue_script('custom-subscribe-script', get_template_directory_uri() . '/src/scripts/block/subscribe.js', array('jquery'), '', true);
        wp_enqueue_script('custom-subscribe-script');
    }
}
add_action('wp_enqueue_scripts', 'vigorCrossfit_scripts');



// Load styles
function vigorCrossfit_styles()
{
}

// deregister acf front-end forms styles
function deregister_unused_styles()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
}
add_action('wp_enqueue_scripts', 'deregister_unused_styles');

// Async asset loading
function add_async_forscript($url)
{
    if (strpos($url, '#asyncload') === false)
        return $url;
    else if (is_admin())
        return str_replace('#asyncload', '', $url);
    else
        return str_replace('#asyncload', '', $url) . "' async='async";
}

// Add page slug to body class
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Serve responsive images for ACF images
function responsive_image($image_id, $max_width = false)
{
    if ($image_id != '') {

        // Get image full width
        $image_width = wp_get_attachment_image_src($image_id, 'full')[1];
        $image_src = wp_get_attachment_image_url($image_id, 'full');
        $image_srcset = wp_get_attachment_image_srcset($image_id);

        // Include sizes attribute if image has max width
        if ($max_width) {
            $image_max_width = ' sizes="(max-width: ' . $image_width . 'px) 100vw, ' . $image_width . 'px"';
        } else {
            $image_max_width = '';
        }
        echo 'src="' . $image_src . '" srcset="' . $image_srcset . '"' . $image_max_width;
    }
}

// Add custom note for custom header image upload
function vigorCrossfit_custom_header_text($wp_customize)
{
    $wp_customize->get_section('header_image')->description = __('The recommended size for the header image is height: 95 px width: 92 px.', 'vigorCrossfit');
}
add_action('customize_register', 'vigorCrossfit_custom_header_text');

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('after_setup_theme', 'vigorCrossfit_setup');
add_action('wp_enqueue_scripts', 'vigorCrossfit_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'vigorCrossfit_styles'); // Add Theme Stylesheet
// add_action('init', 'create_post_types'); // Add custom post types
// add_action('init', 'create_taxonomies', 0); // Add custom taxonomies

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('clean_url', 'add_async_forscript', 11, 1);

//Remove Filters
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');



// Declaring WooCommerce Support
function add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'add_woocommerce_support');