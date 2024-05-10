<?php

add_action('init', 'register_acf_blocks');
function register_acf_blocks()
{
  register_block_type(__DIR__ . '/home-hero-sections');
  register_block_type(__DIR__ . '/slideshow-template');
  register_block_type(__DIR__ . '/boxes');
  register_block_type(__DIR__ . '/gym-locations');
  register_block_type(__DIR__ . '/woocommerce');
  register_block_type(__DIR__ . '/subscribe');
}