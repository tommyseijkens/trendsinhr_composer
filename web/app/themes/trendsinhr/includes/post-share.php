<?php if (!get_field('social_share_uitschakelen')): ?>
    <div class="social-share d-flex flex-row justify-content-start">
        <div class="align-self-center"><h6 class="p-0 m-0 mr-3">Deel deze pagina</h6></div>
        <div>
            <ul class="social d-flex justify-content-center justify-content-lg-start">
                <li>
                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php single_post_title(); ?>%20door%20@Driessen_HRM&hashtags=TrendsinHR"
                       class="twitter-share-button social-link"
                       title="Deel deze pagina met Twitter" target="_blank"></a>
                </li>
                <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"
                       title="Deel deze pagina op Facebook" class="social-link"></a>
                </li>
                <li><a href="http://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>" target="_blank"
                       title="Deel deze pagina op LinkedIn" class="social-link"></a>
                </li>
            </ul>
        </div>
    </div>
<?php endif; ?>






