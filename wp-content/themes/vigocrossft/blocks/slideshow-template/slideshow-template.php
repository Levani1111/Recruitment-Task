<?php
// ACF Slideshow block
$slideshow = get_field('slideshow');
$totalSlides = count($slideshow);
?>

<div class="slideshow-container">
    <div class="slideshow">
        <?php foreach ($slideshow as $slide) : ?>
        <div class="slide" style="background-image: url('<?php echo $slide['slideshow_image']['url']; ?>');">
            <div class="slide-content">
                <div class="slide-title">
                    <?php if ($slide['title']) : ?>
                    <h2><?php echo $slide['title']; ?></h2>
                    <?php endif; ?>
                </div>
                <div class="slide-subtitle">
                    <?php if ($slide['subtitle']) : ?>
                    <p><?php echo $slide['subtitle']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="name">
                    <?php if ($slide['name']) : ?>
                    <p><?php echo $slide['name']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="slide_description">
                    <?php if ($slide['slide_description']) : ?>
                    <p><?php echo $slide['slide_description']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="slide_button">
                    <?php if ($slide['slide_button']) : ?>
                    <a href="<?php echo $slide['slide_button']['url']; ?>"
                        class="button"><?php echo $slide['slide_button']['title']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <a class="prev" onclick="moveSlide(-1)"><i class="icofont-thin-left"></i></a>
    <a class="next" onclick="moveSlide(1)"><i class="icofont-thin-right"></i></a>
    <div class="dots">
        <?php foreach ($slideshow as $index => $slide) : ?>
        <span class="dot" onclick="currentSlide(<?php echo $index + 1; ?>)"></span>
        <?php endforeach; ?>
    </div>
</div>