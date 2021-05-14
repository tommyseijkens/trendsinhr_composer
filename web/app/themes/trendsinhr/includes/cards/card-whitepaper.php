<?php
$image = get_the_post_thumbnail_url(get_the_ID(), 'full');

if ($terms_posttypes[0]->name == '') {
    $terms_posttypes[0]->name = 'Artikel';
}

$color = getThemeColor();

?>


<div class="card-item card-item--whitepaper">
    <a class="card-item__content" href="<?php echo get_the_permalink(); ?>">
        <div class="card-item__background <?php echo $color; ?>">
            <div class="card-item__background--image" style="background-image: url('<?php echo $image; ?>');"></div>
        </div>
        <div class="card-item__description">
            <div class="labels">
                <span class="label card-item__label">Whitepaper</span>
            </div>
            <span class="card-item__title"><?php echo the_title(); ?></span>
        </div>
    </a>
</div>

<?php $color = ''; // reset color ?>