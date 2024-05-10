<?php get_header(); ?>

<main role="main">

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php
            // Parse blocks in order to add html wrapper around non-custom blocks
            $blocks = parse_blocks($post->post_content);
            foreach ($blocks as $block) {
                // Get namespace
                $block_namespace = explode('/', $block['blockName'])[0];

                // Echo opening html
                if ($block_namespace && $block_namespace !== 'recruitment') {
                    echo '<section class="block padded">';
                    echo '<div class="inner">';
                }

                // Render block
                echo apply_filters('the_content', render_block($block));

                // Echo closing html
                if ($block_namespace && $block_namespace !== 'recruitment') {
                    echo '</div>';
                    echo '</section>';
                }
            }
            ?>
        <?php endwhile; ?>
    <?php endif; ?>

</main>

<?php get_footer(); ?>