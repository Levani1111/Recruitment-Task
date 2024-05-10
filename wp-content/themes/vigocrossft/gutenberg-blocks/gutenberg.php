<?php

/**
 * 
 * Registering custom Gutenberg block.
 * 
 */


function registerin_gutenberg_blocks()
{

    wp_register_script(
        'coustom-cta-js',
        get_template_directory_uri() . '/dist/js/index.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n')
    );

    register_block_type('vigocrossft/custom-cta', array(
        'editor_script' => 'coustom-cta-js',
    ));
}

add_action('init', 'registerin_gutenberg_blocks');