<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       Driessen
 * @since      1.0.0
 *
 * @package    Upnext
 * @subpackage Upnext/admin/partials
 */
?>

<div class="wrap">
  <h2>UpNext</h2><?php
  if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ){
    $this->admin_notice();
  } ?>
  <form method="POST" action="options.php">
    <?php
    settings_fields( 'upnext_fields' );
    do_settings_sections( 'upnext_fields' );
    submit_button();
    ?>
  </form>
</div>
