<?php if (get_the_author_meta('display_name') !== "Trends in HR"):
$author_id = get_the_author_meta('ID');
$author_fullname = get_the_author_meta('display_name');
$author_profession = get_field('functie', 'user_' . $author_id);
$author_image = get_field('afbeelding', 'user_' . $author_id);
$minutes = read_time(get_the_content());
$color = getThemeColor();
?>
<div class="page page--column">

    <div class="page-header page-header--column position-relative <?php echo $color; ?>">
        <div class="bg-stripes bg-white">
            <div class="container position-relative <?php echo $color; ?>">
                <div class="bg-stripes__stripe"></div>
                <div class="bg-stripes__stripe"></div>
                <div class="bg-stripes__stripe"></div>
            </div>
        </div>
        <div class="container d-flex flex-column justify-content-end h-100 page-header__authorimage"
             style="background-image: url('<?php echo $author_image['url']; ?>');">
            <div class="row">
                <div class="container-content align-self-end">
                    <div>
                        <div class="labels">
                            <div class="label">Column</div>
                            <div class="label"><?php echo $author_fullname; ?></div>
                            <div class="label">
                                <div class="label__reading-time"><?php echo $minutes; ?> min</div>
                            </div>
                        </div>
                        <h1 class="display-2"><?php echo the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-7">
        <div class="row">
            <div class="container-content the-content">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="row">
            <div class="container-content">
                <?php include('includes/post-share.php'); ?>
            </div>
        </div>
    </div>



</div>
<?php endif; ?>