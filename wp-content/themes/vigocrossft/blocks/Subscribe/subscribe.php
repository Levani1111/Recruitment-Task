<?php
$title = get_field('title');
$subtitle = get_field('subtitle');
$paragraph = get_field('paragraph');
?>

<section class="subscribe-block">
    <div class="inner">
        <div class="wrapper">
            <?php if ($title) : ?>
            <div class="title">
                <h2><?= ($title); ?></h2>
            </div>
            <?php endif; ?>
            <?php if ($subtitle) : ?>
            <div class="subtitle">
                <p><?= ($subtitle); ?></p>
            </div>
            <?php endif; ?>
            <div class="form">
                <div class="email-input">
                    <input type="email" name="email" id="email" placeholder="name@email.com" required>
                </div>
                <div class="submit">
                    <button type="button" id="submitBtn">Subscribe</button>
                </div>
            </div>
            <div class="thank-you-message"></div>
            <?php if ($paragraph) : ?>
            <div class="paragraph">
                <p><?= $paragraph; ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>