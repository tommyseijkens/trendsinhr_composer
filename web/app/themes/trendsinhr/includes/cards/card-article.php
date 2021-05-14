<?php
$image = get_the_post_thumbnail_url(get_the_ID(), 'full');

$illustration = get_field('illustration');
if ($illustration) {
    $color = getThemeColor();
}


if ($terms_posttypes[0]->name) {
    $posttype_name = $terms_posttypes[0]->name;
    } else {
    $posttype_name = 'Artikel';
}

$blank = get_field('blank');

?>

<?php if (!$image == '' && !$blank) { ?>

    <?php if (!$illustration) { ?>
        <div class="card-item card-item--image">
            <a class="card-item__content <?php echo $color; ?>" href="<?php echo get_the_permalink(); ?>">
                <div class="card-item__background"
                     style="background-image: url('<?php echo $image; ?>');"></div>
                <div class="card-item__description">
                    <div class="labels">
                        <span class="label card-item__label"><?php echo $posttype_name; ?></span>
                        <span class="label card-item__label"><?php echo get_the_date('j M', '', ''); ?>&nbsp;'<?php echo get_the_date('y', '', ''); ?></span>
                    </div>
                    <span class="card-item__title"><?php echo the_title(); ?></span>
                </div>
            </a>
        </div>
    <?php } else { ?>
        <div class="card-item card-item--illustration">
            <a class="card-item__content <?php echo $color; ?>" href="<?php echo get_the_permalink(); ?>">
                <div class="card-item__background <?php echo $color; ?>"
                     style="background-image: url('<?php echo $image; ?>');"></div>
                <div class="card-item__description">
                    <div class="labels">
                        <span class="label card-item__label"><?php echo $terms_posttypes[0]->name; ?></span>
                        <span class="label card-item__label"><?php echo get_the_date('j M', '', ''); ?>&nbsp;'<?php echo get_the_date('y', '', ''); ?></span>
                    </div>
                    <span class="card-item__title"><?php echo the_title(); ?></span>
                </div>
            </a>
        </div>
    <?php } ?>

<?php } else { ?>
    <div class="card-item card-item--blank">
        <a class="card-item__content transparent-bg" href="<?php echo get_the_permalink(); ?>">
            <div class="card-item__description">
                <div class="labels">
                    <span class="label card-item__label"><?php echo $terms_posttypes[0]->name; ?></span>
                    <span class="label card-item__label"><?php echo get_the_date('j M', '', ''); ?>&nbsp;'<?php echo get_the_date('y', '', ''); ?></span>
                </div>
                <span class="card-item__title"><?php echo the_title(); ?></span>
            </div>
        </a>
    </div>
<?php }
?>

<?php $color = ''; // reset color ?>

