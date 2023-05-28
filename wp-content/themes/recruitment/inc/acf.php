<?php

function register_acf_options_pages() {

    // Check function exists.
    if( !function_exists('acf_add_options_page') ) return;

    // register options page.
    acf_add_options_page(array(
        'page_title'    => 'Footer Settings',
        'menu_title'    => 'Footer Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'manage_options',
        'redirect'      => true
    ));

    acf_add_options_page(array(
        'page_title'  => 'Footer Settings',
        'menu_title'  => 'Footer Settings',
        'menu_slug'   => 'footer-settings',
        'capability'  => 'manage_options',
        'parent_slug' => 'theme-settings'
    ));
}

// Hook into acf initialization.
add_action('acf/init', 'register_acf_options_pages');
