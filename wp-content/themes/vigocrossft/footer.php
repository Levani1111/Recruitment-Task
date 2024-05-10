<?php

$company_address_title = get_field('company_address_title', 'option');
$company_address = get_field('company_address', 'option');
$site_logo = get_field('site_logo', 'option');
$on_off = get_field('on_off', 'option');

?>

<?php if ($on_off) : ?>
<footer class="footer">
    <div class="inner">
        <section class="footer-up">
            <div class="footer-menu-container">
                <div class="logo">
                    <?php if ($site_logo) : ?>
                    <img src="<?= $site_logo['url']; ?>" alt="<?= $site_logo['alt']; ?>">
                    <?php endif; ?>
                </div>
                <?php if ($company_address_title) : ?>
                <div class="company_address_title">
                    <h3><?= $company_address_title; ?></h3>
                    <?php endif; ?>
                    <?php if ($company_address) : ?>
                    <div class="company_address">
                        <ul class="address-list">
                            <?php while (have_rows('company_address', 'option')) : the_row(); ?>
                            <li class="company-address">
                                <?php if (get_sub_field('item')) : ?>
                                <div class="address-item">
                                    <p><?= get_sub_field('item'); ?></p>
                                </div>
                                <?php endif; ?>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'menu_class'     => 'footer-menu',
                        ));
                        ?>
            </div>
        </section>
    </div>
</footer>
<?php endif; ?>

<?php wp_footer(); ?>

</body>

</html>