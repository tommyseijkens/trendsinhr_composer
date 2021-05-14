<?php

// author
$author_id = get_the_author_meta('ID');
$image = get_field('afbeelding', 'user_' . $author_id);

if ($image) {
    $image = $image['url'];
} else {
    $image = get_template_directory_uri() . "/assets/img/Driessen-HRM.png";
}

$color = getThemeColor();

?>

<div class="card-item card-item--column">
    <a class="card-item__content" href="<?php echo get_the_permalink(); ?>">
        <div class="card-item__background <?php echo $color; ?>"
             style="background-image: url('<?php echo $image; ?>');');"></div>
        <div class="card-item__description">
            <div class="labels">
                <span class="label card-item__label"><?php the_author_meta('display_name'); ?></span>
            </div>
            <span class="card-item__title"><?php echo the_title(); ?></span>
        </div>
    </a>
</div>

<?php $color = ''; // reset color ?>