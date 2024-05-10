<?php
$title = get_field('title');
$boxes = get_field('boxes');
$list = get_field('list');
$cta = get_field('cta');

?>

<section class="boxes">
    <div class="box-container">
        <div class="inner">
            <div class="wrapper">
                <div class="section-title">
                    <?php if ($title) : ?>
                    <h1><?php echo $title; ?></h1>
                    <?php endif; ?>
                </div>
                <?php foreach ($boxes as $box) : ?>
                <div class="box">
                    <?php if ($box['title']) : ?>
                    <h2><?php echo $box['title']; ?></h2>
                    <?php endif; ?>
                    <?php if ($box['list']) : ?>
                    <ul>
                        <?php $itemCount = 0; ?>
                        <?php foreach ($box['list'] as $item) : ?>
                        <?php $itemCount++; ?>
                        <li>
                            <?php echo $item['list_item']; ?>
                            <?php
                                        $changeColorClass = '';
                                        if ($itemCount >= 3 && $itemCount < 5) {
                                            $changeColorClass = 'change-color';
                                        } elseif ($itemCount >= 5) {
                                            $changeColorClass = 'change-color-again';
                                        }
                                        ?>
                            <i class="icofont-check-alt <?php echo $changeColorClass; ?>"></i>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <div class="box-footer">
                        <?php if ($box['cta']) : ?>
                        <a href="<?php echo $box['cta']['url']; ?>"
                            class="button-cta"><?php echo $box['cta']['title']; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>