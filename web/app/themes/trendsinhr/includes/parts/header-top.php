<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-3 my-5">
                <a href="<?php echo get_site_url(); ?>" target="_self" class="header-top__logo"></a>
            </div>
            <div class="col-6 offset-2 offset-xl-1 header-cta">
                <a href="<?php the_field('banner_header_link', 'option'); ?>" target="_self" class="header-cta--link">
                    <div class="row">
                        <div class="col-3 header-cta--image">
                            <?php $image = get_field('banner_header_image', 'option'); ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                        </div>
                        <div class="col-8 offset-1 offset-xl-0 col-xl-9 header-cta--text">
                            <div class="header-cta--text__title">
                                Magazine Trends in HR
                            </div>
                            <span class="header-cta--text__tagline">
                                Abonneer nu gratis
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col header-search">
                <div class="search"><a href="#" class="icon icon-search"></a>
            </div>
        </div>
    </div>
</div>
