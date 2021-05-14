<div class="card-item card-item--banner">
    <div class="card-item__content">
        <div class="card-item__banner-content">
            <!-- custom banner content -->
            <?php
            $selector = rand(1,3);
            if ( empty(get_field('bannerhtml_'.$selector,'option')) ) { $selector = '1'; }
            echo get_field('bannerhtml_'.$selector,'option');
            ?>
            <!-- end custom banner content -->
        </div>
    </div>
</div>
