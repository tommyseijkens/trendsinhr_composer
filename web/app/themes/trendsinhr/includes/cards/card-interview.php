<?php

$author_id = get_the_author_meta('ID');
$image = get_the_post_thumbnail_url(get_the_ID(), 'full');
$color = getThemeColor();

?>

<div class="card-item card-item--interview">
    <a class="card-item__content" href="<?php echo get_the_permalink(); ?>">
        <div class="card-item__background <?php echo $color; ?>" style="background-image: url('<?php echo $image; ?>');"></div>
        <div class="card-item__description">
            <div class="labels">
                <span class="label card-item__label">Interview</span>
            </div>
            <span class="card-item__title"><?php echo the_title(); ?></span>
        </div>
    </a>
</div>

<?php $color = ''; // reset color ?>