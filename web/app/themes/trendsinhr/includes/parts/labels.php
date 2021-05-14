<?php
$minutes = read_time(get_the_content());
?>

<div class="labels">
    <div class="label"><?php echo $posttypeName; ?></div>
    <div class="label">
        <div class="label__shortdate d-inline-block d-md-none"><?php echo get_the_date('j M', '', ''); ?>&nbsp;'<?php echo get_the_date('y', '', ''); ?></div>
        <div class="label__longdate d-none d-md-inline-block"><?php echo get_the_date('j F', '', ''); ?>&nbsp;'<?php echo get_the_date('y', '', ''); ?></div>
    </div>
    <div class="label">
        <div class="label__reading-time"><?php echo $minutes; ?> min</div>
    </div>
</div>



