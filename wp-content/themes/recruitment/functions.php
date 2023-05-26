<?php
/*------------------------------------*\
    Globals
\*------------------------------------*/

/*------------------------------------*\
    External Modules/Files
\*------------------------------------*/

// require_once('inc/acf.php');
// require_once('blocks/index.php');

/*------------------------------------*\
    Theme Support
\*------------------------------------*/
add_theme_support('custom-header');

// Include the WP_Customize_Control class
require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

function recruitment_setup()
{
    // Add Theme Support

    register_nav_menus(array(
        'primary' => 'primary',
        // 'main-menu' => 'Main Menu',
        // 'footer-menu' => 'Footer Menu',
        // 'contact-us' => 'Contact Us',
        // 'social-media' => 'Social Media'
    ));
}

add_action('after_setup_theme', 'recruitment_setup');

// Futered image support for portfolio post type
// function add_portfolio_featured_image()
// {
//     add_theme_support('post-thumbnails', array('portfolio'));
// }
// add_action('after_setup_theme', 'add_portfolio_featured_image');


/*------------------------------------*\
    Functions
\*------------------------------------*/

// Load scripts (header.php)
function recruitment_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('recruitment', get_template_directory_uri() . '/dist/js/scripts.min.js', array('jquery'), '', true);

        wp_enqueue_script('recruitment');

        // Load templates/portfolio.js
        // wp_register_script('portfolio', get_template_directory_uri() . '/dist/js/portfolio.js', array('jquery'), '', true);

        // wp_enqueue_script('portfolio');
    }
}
add_action('wp_enqueue_scripts', 'recruitment_scripts');



// Load styles
function recruitment_styles()
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
// function responsive_image($image_id, $max_width = false)
// {
//     if ($image_id != '') {

//         // Get image full width
//         $image_width = wp_get_attachment_image_src($image_id, 'full')[1];
//         $image_src = wp_get_attachment_image_url($image_id, 'full');
//         $image_srcset = wp_get_attachment_image_srcset($image_id);

//         // Include sizes attribute if image has max width
//         if ($max_width) {
//             $image_max_width = ' sizes="(max-width: ' . $image_width . 'px) 100vw, ' . $image_width . 'px"';
//         } else {
//             $image_max_width = '';
//         }
//         echo 'src="' . $image_src . '" srcset="' . $image_srcset . '"' . $image_max_width;
//     }
// }

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('after_setup_theme', 'recruitment_setup');
add_action('wp_enqueue_scripts', 'recruitment_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'recruitment_styles'); // Add Theme Stylesheet
// add_action('init', 'create_post_types'); // Add custom post types
// add_action('init', 'create_taxonomies', 0); // Add custom taxonomies

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('clean_url', 'add_async_forscript', 11, 1);

//Remove Filters
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// function create_post_types()
// {
//     register_post_type(
//         'branches', // Register Custom Post Type
//         array(
//             'labels' => array(
//                 'name' => 'Branches', // Rename these to suit
//                 'singular_name' => 'Branch',
//                 'add_new' => 'Add New',
//                 'add_new_item' => 'Add New Branch',
//                 'edit' => 'Edit',
//                 'edit_item' => 'Edit Branch',
//                 'new_item' => 'New Branch',
//                 'view' => 'View',
//                 'view_item' => 'View Branch',
//                 'search_items' => 'Search Branches',
//                 'not_found' => 'No Branches found',
//                 'not_found_in_trash' => 'No Branches found in Trash'
//             ),
//             'public' => true,
//             'publicly_queryable' => false,
//             'rewrite' => true,
//             'hierarchical' => true,
//             'has_archive' => true,
//             'show_in_rest' => true, // Enable Block Editor
//             'supports' => array(),
//             'taxonomies' => array(),
//             'menu_icon' => 'dashicons-location',
//             'can_export' => true, // Allows export in Tools > Export
//         )
//     );
// }

// function create_taxonomies()
// {
//     register_taxonomy(
//         'states',
//         'branches',
//         array(
//             'labels' => array(
//                 'name' => 'States',
//                 'singular_name' => 'State',
//                 'add_new' => 'Add New',
//                 'add_new_item' => 'Add New State',
//                 'edit' => 'Edit',
//                 'edit_item' => 'Edit State',
//                 'new_item' => 'New State',
//                 'view' => 'View',
//                 'view_item' => 'View State',
//                 'search_items' => 'Search States',
//                 'not_found' => 'No States found',
//                 'not_found_in_trash' => 'No States found in Trash'
//             ),
//             'hierarchical' => true,
//             'show_in_rest' => true
//         )
//     );

//     register_taxonomy(
//         'regions',
//         'branches',
//         array(
//             'labels' => array(
//                 'name' => 'Regions',
//                 'singular_name' => 'Region',
//                 'add_new' => 'Add New',
//                 'add_new_item' => 'Add New Region',
//                 'edit' => 'Edit',
//                 'edit_item' => 'Edit Region',
//                 'new_item' => 'New Region',
//                 'view' => 'View',
//                 'view_item' => 'View Region',
//                 'search_items' => 'Search Regions',
//                 'not_found' => 'No Regions found',
//                 'not_found_in_trash' => 'No Regions found in Trash'
//             ),
//             'hierarchical' => true,
//             'show_in_rest' => true
//         )
//     );
// }


// /*------------------------------------*\
//     Custom Post Types Portfolio
// \*------------------------------------*/

// function portfolio_post_type()
// {
//     register_post_type(
//         'portfolio',
//         array(
//             'labels' => array(
//                 'name' => __('Portfolio'),
//                 'singular_name' => __('Portfolio Item')
//             ),
//             'public' => true,
//             'has_archive' => true,
//             'rewrite' => array('slug' => 'portfolio'),
//             'taxonomies' => array('category'),
//             'supports' => array('title', 'editor', 'thumbnail')
//         )
//     );
// }
// add_action('init', 'portfolio_post_type');

// // Remove Add Media Button

// function remove_add_media_button($post_type)
// {
//     global $current_screen;
//     if ($current_screen->post_type == 'portfolio') {
//         remove_action('media_buttons', 'media_buttons');
//     }
//     if ($post_type === 'portfolio') {
//         $screen = get_current_screen();
//         if (is_object($screen) && $screen->id == 'portfolio') {
//             remove_meta_box('postimagediv', 'portfolio', 'side');
//             add_meta_box('postimagediv', __('Card Image'), 'post_thumbnail_meta_box', 'portfolio', 'side', 'low');
//         }
//     }
// }
// add_action('add_meta_boxes', 'remove_add_media_button');





/*------------------------------------*\
    Gutenberg Patterns
\*------------------------------------*/

// function register_patterns_category() {
//     register_block_pattern_category(
//         'levani-papashvili',
//         array( 'label' => __( 'Levani Papashvili', 'levani-papashvili' ) )
//     );
// }
// add_action( 'init', 'register_patterns_category' );

// function register_patterns() {
//     register_block_pattern(
//         'patterns/home',
//         array(
//             'title'       => 'Home',
//             'categories'  => array('levani-papashvili'),
//             'description' => 'Adds all the blocks used on the Home page',
//             'content'    => '
//                 <!-- wp:levani-papashvili/home-hero-section /-->
//             '
//         )
//     );

//     register_block_pattern(
//         'patterns/educational-program-landing',
//         array(
//             'title'       => 'Education Program Landing',
//             'categories'  => array('levani-papashvili'),
//             'keywords'    => array('levani-papashvili','pattern'),
//             'description' => 'Adds all the blocks used on an Education Program Landing page',
//             'content'     => '
//                 <!-- wp:levani-papashvili/side-by-side /-->
//                 <!-- wp:levani-papashvili/left-image-right-text /-->
//                 <!-- wp:levani-papashvili/accordion /-->
//                 <!-- wp:levani-papashvili/full-width-cta /-->
//             '
//         )
//     );

//     register_block_pattern(
//         'patterns/educational-program-individual',
//         array(
//             'title'       => 'Education Program Individual',
//             'categories'  => array('levani-papashvili'),
//             'keywords'    => array('levani-papashvili','pattern'),
//             'description' => 'Adds all the blocks used on an Education Program Individual page',
//             'content'     => '
//                 <!-- wp:levani-papashvili/content-over-image /-->
//                 <!-- wp:levani-papashvili/basic-full-width /-->
//                 <!-- wp:core/separator /-->
//                 <!-- wp:levani-papashvili/headline-over-grid /-->
//                 <!-- wp:core/separator /-->
//                 <!-- wp:imagely/nextgen-gallery /-->
//                 <!-- wp:core/separator /-->
//                 <!-- wp:levani-papashvili/table-or-chart /-->
//                 <!-- wp:core/separator /-->
//                 <!-- wp:levani-papashvili/accordion /-->
//                 <!-- wp:levani-papashvili/full-width-cta /-->
//             '
//         )
//     );

//     register_block_pattern(
//         'patterns/membership',
//         array(
//             'title'       => 'Membership',
//             'categories'  => array('levani-papashvili'),
//             'keywords'    => array('levani-papashvili','pattern'),
//             'description' => 'Adds all the blocks used on a Membership page',
//             'content'     => '
//                 <!-- wp:core/spacer /-->
//                 <!-- wp:levani-papashvili/left-heading-right-text /-->
//                 <!-- wp:levani-papashvili/content-over-image /-->
//                 <!-- wp:levani-papashvili/single-left-image-right-text /-->
//                 <!-- wp:levani-papashvili/bullet-list /-->
//             '
//         )
//     );

//     register_block_pattern(
//         'patterns/contact',
//         array(
//             'title'       => 'Contact',
//             'categories'  => array('levani-papashvili'),
//             'keywords'    => array('levani-papashvili','pattern'),
//             'description' => 'Adds all the blocks used on a Contact page',
//             'content'     => '
//                 <!-- wp:levani-papashvili/simple-form /-->
//                 <!-- wp:levani-papashvili/left-text-right-embed /-->
//             '
//         )
//     );

//     register_block_pattern(
//         'patterns/support',
//         array(
//             'title'       => 'Support',
//             'categories'  => array('levani-papashvili'),
//             'keywords'    => array('levani-papashvili','pattern'),
//             'description' => 'Adds all the blocks used on a Support page',
//             'content'     => '
//                 <!-- wp:levani-papashvili/content-over-image /-->
//                 <!-- wp:levani-papashvili/side-scrolling-items /-->
//                 <!-- wp:levani-papashvili/accordion /-->
//             '
//         )
//     );

//     register_block_pattern(
//         'patterns/about',
//         array(
//             'title'       => 'About',
//             'categories'  => array('levani-papashvili'),
//             'keywords'    => array('levani-papashvili','pattern'),
//             'description' => 'Adds all the blocks used on an About page',
//             'content'     => '
//                 <!-- wp:levani-papashvili/content-over-image /-->
//                 <!-- wp:levani-papashvili/left-heading-right-text /-->
//                 <!-- wp:levani-papashvili/images-above-content /-->
//                 <!-- wp:levani-papashvili/accordion /-->
//                 <!-- wp:levani-papashvili/left-content-right-image /-->
//                 <!-- wp:levani-papashvili/full-width-content-above-image /-->
//                 <!-- wp:levani-papashvili/full-width-cta /-->
//                 <!-- wp:core/spacer /-->
//             '
//         )
//     );

//     register_block_pattern(
//         'patterns/donate',
//         array(
//             'title'       => 'Donate',
//             'categories'  => array('levani-papashvili'),
//             'keywords'    => array('levani-papashvili','pattern'),
//             'description' => 'Adds all the blocks used on a Donate page',
//             'content'     => '
//                 <!-- wp:levani-papashvili/form-and-image /-->
//             '
//         )
//     );

//     register_block_pattern(
//         'patterns/branch-home',
//         array(
//             'title'       => 'Branch Home',
//             'categories'  => array('levani-papashvili'),
//             'keywords'    => array('levani-papashvili','pattern'),
//             'description' => 'Adds all the blocks used on a Branch Home page',
//             'content'     => '
//                 <!-- wp:levani-papashvili/content-over-image /-->
//                 <!-- wp:levani-papashvili/full-width-cta /-->
//                 <!-- wp:core/shortcode -->[tribe_events view="summary"]<!-- /wp:core/shortcode -->
//                 <!-- wp:levani-papashvili/side-by-side /-->
//                 <!-- wp:levani-papashvili/full-width-cta /-->
//                 <!-- wp:core/spacer /-->
//                 <!-- wp:imagely/nextgen-gallery /-->
//             '
//         )
//     );

//     register_block_pattern(
//         'patterns/news-events',
//         array(
//             'title'       => 'News & Events',
//             'categories'  => array('levani-papashvili'),
//             'keywords'    => array('levani-papashvili','pattern'),
//             'description' => 'Adds all the blocks used on a News & Events page',
//             'content'     => '
//                 <!-- wp:core/spacer /-->
//                 <!-- wp:levani-papashvili/single-left-image-right-text /-->
//                 <!-- wp:events-calendar-shortcode/block /-->
//                 <!-- wp:levani-papashvili/full-width-cta /-->
//             '
//         )
//     );

// }
// add_action( 'init', 'register_patterns' );





function custom_theme_customizer($wp_customize)
{
    // Add custom section for header settings
    $wp_customize->add_section('custom_header_section', array(
        'title' => 'Header Settings',
        'priority' => 30,
    ));

    // Add header fields repeater control
    $wp_customize->add_setting('header_fields', array(
        'default' => '',
        'sanitize_callback' => 'custom_sanitize_header_fields',
    ));

    $wp_customize->add_control(new Custom_Header_Fields_Control($wp_customize, 'header_fields', array(
        'label' => 'Header Fields',
        'section' => 'custom_header_section',
        'settings' => 'header_fields',
    )));
}

add_action('customize_register', 'custom_theme_customizer');

// Custom sanitizer for header fields
function custom_sanitize_header_fields($value)
{
    $header_fields = array();

    if (is_array($value)) {
        foreach ($value as $field) {
            $header_text = isset($field['header_text']) ? sanitize_text_field($field['header_text']) : '';
            $header_link = isset($field['header_link']) ? esc_url_raw($field['header_link']) : '';

            if (!empty($header_text) || !empty($header_link)) {
                $header_fields[] = array(
                    'header_text' => $header_text,
                    'header_link' => $header_link,
                );
            }
        }
    }

    return $header_fields;
}

class Custom_Header_Fields_Control extends WP_Customize_Control
{
    public $type = 'header_fields';

    public function render_content()
    {
        $header_fields = $this->value();

        if (empty($header_fields)) {
            $header_fields = array(
                array(
                    'header_text' => '',
                    'header_link' => '',
                ),
            );
        }
    ?>
        <ul id="header-fields-list">
            <?php foreach ($header_fields as $index => $field) : ?>
                <li class="header-field">
                    <div class="header-field-wrapper">
                        <input type="text" class="header-text" value="<?php echo esc_attr($field['header_text']); ?>" data-field="header_text" placeholder="Header Text">
                        <input type="url" class="header-link" value="<?php echo esc_attr($field['header_link']); ?>" data-field="header_link" placeholder="Header Link">
                    </div>
                    <button class="remove-header-field button">Remove Button</button>
                </li>
            <?php endforeach; ?>
        </ul>
        <button id="add-header-field" class="button-primary">Add Button</button>
        <script>
            (function($) {
                // Initialize the header fields control
                var headerFieldsControl = {
                    init: function() {
                        this.addListeners();
                    },

                    addListeners: function() {
                        var control = this;

                        // Add more header field
                        $(document).on('click', '#add-header-field', function(e) {
                            e.preventDefault();
                            control.addHeaderField();
                        });

                        // Remove header field
                        $(document).on('click', '.remove-header-field', function(e) {
                            e.preventDefault();
                            control.removeHeaderField($(this));
                        });

                        // Save changes on control update
                        $(document).on('change', '.header-text, .header-link', function() {
                            control.save();
                        });
                    },

                    addHeaderField: function() {
                        var fieldIndex = $('#header-fields-list .header-field').length;

                        var fieldHTML = '<li class="header-field">' +
                            '<div class="header-field-wrapper">' +
                            '<input type="text" class="header-text" name="<?php echo $this->id; ?>[' + fieldIndex + '][header_text]" data-field="header_text" placeholder="Header Text">' +
                            '<input type="url" class="header-link" name="<?php echo $this->id; ?>[' + fieldIndex + '][header_link]" data-field="header_link" placeholder="Header Link">' +
                            '</div>' + 
                            '<button class="remove-header-field button">Remove button</button>' +
                            '</li>';

                        $('#header-fields-list').append(fieldHTML);
                        this.save();
                    },

                    removeHeaderField: function($button) {
                        $button.closest('.header-field').remove();
                        this.save();
                    },

                    save: function() {
                        var headerFields = [];

                        $('#header-fields-list .header-field').each(function(index) {
                            var headerText = $(this).find('.header-text').val();
                            var headerLink = $(this).find('.header-link').val();

                            headerFields.push({
                                header_text: headerText,
                                header_link: headerLink
                            });
                        });

                        wp.customize('<?php echo $this->id; ?>', function(obj) {
                            obj.set(headerFields);
                        });
                    }
                };

                $(document).ready(function() {
                    headerFieldsControl.init();
                });
            })(jQuery);
        </script>
    <?php
    }
}
