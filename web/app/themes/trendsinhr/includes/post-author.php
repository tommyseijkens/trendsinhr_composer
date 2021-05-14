<?php if (get_the_author_meta('display_name') !== "Trends in HR"):
    $author_id = get_the_author_meta('ID');
    $author_fullname = get_the_author_meta('display_name');
    $author_profession = get_field('functie', 'user_' . $author_id);
    $author_image = get_field('afbeelding', 'user_' . $author_id);
    ?>
    <div class="row meta-author">
        <div class="container-content d-flex flex-row">
            <div class="meta-author__image">
                <img src="<?php echo $author_image['url']; ?>">
            </div>
            <div class="align-self-center ml-7">
                <div class="meta-author__name">
                    <?php echo $author_fullname; ?>
                </div>
                <div class="meta-author__jobtitle">
                    <?php echo $author_profession; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>