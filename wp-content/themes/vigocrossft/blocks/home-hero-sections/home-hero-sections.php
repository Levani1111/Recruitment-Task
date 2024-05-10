<?php
// hero image
$hero_image = get_field('hero_image');


// Section One Variables 
$title = get_field('title');
$paragraph = get_field('paragraph');
$image = get_field('image');
$list = get_field('list');

// Section Two Variables
$section_one_title = get_field('section_two_title');
$Section_one_Subtitle = get_field('section_two_subtitle');

?>



<section class="home-hero-sections" style="background-image: url('<?= $hero_image['url']; ?>');">
    <div class="header-wrapper">
        <header class="header">
            <?php if (has_nav_menu('primary')) : ?>
            <nav class="main-nav">
                <?php if (get_header_image()) : ?>
                <div id="site-header">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php header_image(); ?>" width="<?php echo absint(get_custom_header()->width); ?>"
                            height="<?php echo absint(get_custom_header()->height); ?>"
                            alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                    </a>
                    <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                    <?php else : ?>
                    <div class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                            rel="home"><?php bloginfo('name'); ?></a></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'nav-menu',
                        'depth' => 0,
                    )); ?>

                <?php
                    $header_fields = get_theme_mod('header_fields');

                    if (!empty($header_fields)) {
                        echo '<ul class="buttons">';
                        foreach ($header_fields as $field) {
                            $header_text = isset($field['header_text']) ? $field['header_text'] : '';
                            $header_link = isset($field['header_link']) ? $field['header_link'] : '';

                            if (!empty($header_text) && !empty($header_link)) {
                                echo '<li><a href="' . esc_url($header_link) . '" target="_blank">' . esc_html($header_text) . '</a></li>';
                            }
                        }
                        echo '</ul>';
                    }
                    ?>
                <input type="checkbox" id="menu-toggle">
                <label class="menu-icon" for="menu-toggle">
                    <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/Vector.png" alt="Menu Icon">
                </label>
            </nav>
            <?php endif; ?>
        </header>
    </div>
    <div class="inner">
        <div class="home-hero-sections-container">
            <div class="home-hero-sections-title">
                <?php if ($title) : ?>
                <div class="heading-1">
                    <h1><?= $title; ?><h1>
                </div>
                <?php endif; ?>
                <?php if ($paragraph) : ?>
                <div class="sub-heading-6"><?= $paragraph; ?></div>
                <?php endif; ?>

            </div>
            <div class="buttons">
                <?php if (have_rows('buttons')) : ?>
                <?php $button_index = 0; ?>
                <?php while (have_rows('buttons')) : the_row(); ?>
                <?php $button = get_sub_field('button'); ?>
                <?php if (is_array($button)) : ?>
                <?php $button_class = ($button_index == 0) ? 'button' : 'button-second'; ?>
                <a href="<?= $button['url'] ?>" class="<?= $button_class ?>" target="<?= $button['target'] ?>">
                    <?= $button['title'] ?>
                </a>
                <?php $button_index++; ?>
                <?php endif; ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($image) : ?>
        <div class="home-hero-sections-right" style="background-image: url('<?= $image['url']; ?>');"></div>
        <?php endif; ?>
    </div>
    </div>
</section>

<section class="home-hero-sections-one">
    <div class="inner">
        <div class="section-title">
            <?php if ($section_one_title) : ?>
            <div class="paragraph-right">
                <span><?= $section_one_title; ?></span>
            </div>
            <?php endif; ?>
            <?php if ($Section_one_Subtitle) : ?>
            <div class="paragraph-left"><?= $Section_one_Subtitle; ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>