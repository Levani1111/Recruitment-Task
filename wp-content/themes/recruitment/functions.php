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


// Include the WP_Customize_Control class
require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

function recruitment_setup()
{

    register_nav_menus(array(
        'primary' => 'primary',
        'footer-menu' => 'Footer Menu',
    ));
}

add_action('after_setup_theme', 'recruitment_setup');

/*------------------------------------*\
    Functions
\*------------------------------------*/

// Load scripts (header.php)
function recruitment_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('recruitment', get_template_directory_uri() . '/dist/js/scripts.min.js', array('jquery'), '', true);

        wp_enqueue_script('recruitment');
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
function recruitment_custom_header_text($wp_customize)
{
    $wp_customize->get_section('header_image')->description = __('The recommended size for the header image is height: 95 px width: 92 px.', 'recruitment');
}
add_action('customize_register', 'recruitment_custom_header_text');

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





function custom_theme_customizer($wp_customize)
{
    // Add custom section for header settings
    $wp_customize->add_section('custom_header_section', array(
        'title' => 'Add Header Buttons',
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
