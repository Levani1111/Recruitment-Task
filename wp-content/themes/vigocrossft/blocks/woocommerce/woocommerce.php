<?php
$title = get_field('title');
$subtitle = get_field('subtitle');
$button = get_field('button');
$shortcode = get_field('shortcode');

?>

<section class="woocommerce-block">
    <div class="inner">
        <div class="wrapper">
            <div class="woocommerce-fields">
                <?php if ($title) : ?>
                <div class="title">
                    <h2><?= $title; ?></h2>
                </div>
                <?php endif; ?>
                <?php if ($subtitle) : ?>
                <div class="subtitle">
                    <p><?= $subtitle; ?></p>
                </div>
                <?php endif; ?>
                <?php if ($button) : ?>
                <div class="button">
                    <a href="<?= $button['url']; ?>" class="button" target="<?= $button['target']; ?>">
                        <?= $button['title']; ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="shortcode">
                <?php
                $shortcode = get_field('shortcode');
                if ($shortcode) {
                    echo do_shortcode($shortcode);
                }
                ?>
            </div>
        </div>
    </div>
</section>