<div class="nav-main">
    <div class="nav-main__border">
        <div class="container position-relative">
            <div class="row">
                <div class="col-12 nav-main__scroller">
                    <div class="nav-main__scroller-left"></div>
                    <div class="nav-main__scroller-right active"></div>
                    <div class="nav-main__wrapper d-flex justify-content-start justify-content-lg-between">
                        <?php wp_nav_menu(array('menu' => 'Main', 'container' => false )); ?>
                        <?php wp_nav_menu(array('menu' => 'Items', 'container' => false )); ?>
                        <?php wp_nav_menu(array('menu' => 'Publications', 'container' => false )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-pubs nav-pubs-trigger">
        <div class="container d-flex py-5">
            <?php wp_nav_menu(array('menu' => 'Publications', 'container' => false, 'items_wrap' => '%3$s', 'walker' => new Publications_Menu() )); ?>
        </div>
    </div>
</div>

<?php include(dirname(__FILE__).'/../searchbar.php'); ?>