<?php
// Section One Variables 
$title = get_field('title');
$paragraph = get_field('paragraph');
$image = get_field('image');
$list = get_field('list');

// Section Two Variables
$section_two_title = get_field('section_two_title');
$Section_two_Subtitle = get_field('section_two_subtitle');
$section_two_boxes = get_field('section_two_boxes');

?>

<section class="home-hero-sections">
    <div class="inner">
        <div class="home-hero-sections-container">
            <div class="home-hero-sections-left">
                <?php if ($title) : ?>
                    <div class="heading-3"><?= $title; ?></div>
                <?php endif; ?>
                <?php if ($paragraph) : ?>
                    <div class="body-1"><?= $paragraph; ?></div>
                <?php endif; ?>
                <div class="list">
                    <?php if ($list) : ?>
                        <ul>
                            <?php foreach ($list as $item) : ?>
                                <li><?= $item['lists']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($image) : ?>
                <div class="home-hero-sections-right" style="background-image: url('<?= $image['url']; ?>');"></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="home-hero-sections-two">
    <div class="inner">
        <div class="section-title">
            <?php if ($section_two_title) : ?>
                <div class="heading-2">
                    <span><?= $section_two_title; ?></span>
                </div>
            <?php endif; ?>
            <?php if ($Section_two_Subtitle) : ?>
                <div class="body-1"><?= $Section_two_Subtitle; ?></div>
            <?php endif; ?>
        </div>
        <div class="box-section">
            <div class="box">
                <?php if (have_rows('section_two_boxes')) : ?>
                    <div class="section-container">
                        <?php while (have_rows('section_two_boxes')) : the_row(); ?>
                            <?php $box_image = get_sub_field('box_image'); ?>
                            <?php $box_title = get_sub_field('box_title'); ?>
                            <?php $box_subtitle = get_sub_field('box_subtitle'); ?>
                            <?php $border_color = get_sub_field('border_color'); ?>
                            <div class="box" <?php if ($border_color) : ?>style="border: 4px solid <?php the_sub_field('border_color'); ?>" <?php endif; ?>>
                                <?php if ($box_image) : ?>
                                    <div class="box-image" style="background-image: url('<?= $box_image['url']; ?>');"></div>
                                <?php endif; ?>
                                <?php if ($box_title) : ?>
                                    <div class="heading-4"><?= $box_title; ?></div>
                                <?php endif; ?>
                                <?php if ($box_subtitle) : ?>
                                    <div class="body-1"><?= $box_subtitle; ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>