<?php
$image = get_the_post_thumbnail_url(get_the_ID(), 'full');
$color = getThemeColor();


?>
<div class="page page--whitepaper">

    <div class="page-header page-header--whitepaper <?php echo $color; ?>">
        <div class="page-header__image">
            <div class="page-header__background-image"
                 style="background-image: url('<?php echo $image; ?>');"></div>
            <div class="page-header__background-image"
                 style="background-image: url('<?php echo $image; ?>');"></div>
        </div>
        <div class="container d-flex flex-column justify-content-end h-100">
            <div class="row">
                <div class="container-content">
                    <div>
                        <div class="labels">
                            <div class="label">Publicatie</div>
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
    </div>

</div>
