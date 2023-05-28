<?php

$paragraph = get_field('paragraph', 'option');
$social_media = get_field('social_media', 'option');
$footer_down = get_field('footer_down', 'option');
$on_off = get_field('on_off', 'option');

?>

<?php if ($on_off) : ?>
    <footer class="footer">
        <div class="inner">
            <section class="footer-up">
                <div class="footer-menu-container">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-menu',
                        'menu_class'     => 'footer-menu',
                    ));
                    ?>
                </div>
                <div class="social-media">
                    <?php if (have_rows('social_media', 'option')) : ?>
                        <ul>
                            <?php while (have_rows('social_media', 'option')) : the_row(); ?>
                                <?php $link = get_sub_field('social'); ?>
                                <li>
                                    <?php if ($link) : ?>
                                        <a href="<?= $link; ?>" target="_blank">
                                            <i class="icofont"><?= get_sub_field('icons'); ?></i>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="paragraph">
                    <?php if ($paragraph) : ?>
                        <p><?= $paragraph; ?></p>
                    <?php endif; ?>
                </div>
            </section>
            <section class="footer-down">
                <?php if (have_rows('footer_down', 'option')) : ?>
                    <div class="footer-down-container">
                        <?php while (have_rows('footer_down', 'option')) : the_row(); ?>
                            <?php $link = get_sub_field('link'); ?>
                            <?php if ($link && $link['title']) : ?>
                                <a href="<?= esc_url($link['url']); ?>" target="_blank">
                                    <span><?= esc_html($link['title']); ?></span>
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </section>
        </div>
    </footer>
<?php endif; ?>

<?php wp_footer(); ?>

</body>

</html>