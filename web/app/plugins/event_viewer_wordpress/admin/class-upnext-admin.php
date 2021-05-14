<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       Driessen
 * @since      1.0.0
 *
 * @package    Upnext
 * @subpackage Upnext/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 * Based upon: https://github.com/rayman813/smashing-custom-fields/blob/master/smashing-fields-approach-1/smashing-fields.php
 *
 * @package    Upnext
 * @subpackage Upnext/admin
 * @author     Driessen Groep <webmasters@driessengroep.nl>
 */
class Upnext_Admin
{

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string $plugin_name The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string $version The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string $plugin_name The name of this plugin.
   * @param      string $version The version of this plugin.
   */
  public function __construct($plugin_name, $version)
  {

    $this->plugin_name = $plugin_name;
    $this->version = $version;

  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles()
  {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Upnext_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Upnext_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/upnext-admin.css', array(), $this->version, 'all');

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts()
  {

    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Upnext_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Upnext_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/upnext-admin.js', array('jquery'), $this->version, false);

  }

  /**
   * Register the settings page.
   *
   * @since    1.0.0
   */
  public function add_admin_menu()
  {
    add_options_page('UpNext', __('UpNext', 'upnext'), 'manage_options', 'upnext', array($this, 'create_admin_interface'));
  }

  /**
   * Callback function for the admin settings page.
   *
   * @since    1.0.0
   */
  public function create_admin_interface()
  {

    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/upnext-admin-display.php';

  }

  /**
   * Admin notice.
   *
   * @since    1.0.0
   */
  public function admin_notice()
  {
  }

  /**
   * Setup sections
   */
  public function setup_sections()
  {
    add_settings_section('api', 'API', array($this, 'section_callback'), 'upnext_fields');
    add_settings_section('google_api', 'Google', array($this, 'section_callback'), 'upnext_fields');
    add_settings_section('extensions', 'Extensions', array($this, 'section_callback'), 'upnext_fields');
    add_settings_section('page', 'Page', array($this, 'section_callback'), 'upnext_fields');
    add_settings_section('labels', 'Labels', array($this, 'section_callback'), 'upnext_fields');
    add_settings_section('text', 'Text', array($this, 'section_callback'), 'upnext_fields');
  }

  /**
   * Section callback.
   *
   * @param $arguments
   *
   * @since    1.0.0
   */
  public function section_callback($arguments)
  {
    switch ($arguments['id']) {
      case 'api':
        echo 'API settings.';
        break;
      case 'google_api':
        break;
      case 'extensions':
        break;
      case 'page':
        echo 'Event detail page settings.';
        break;
      case 'labels':
        echo 'Short words and sentences.';
        break;
    }
  }

  /**
   * Setup fields.
   *
   * @since    1.0.0
   */
  public function setup_fields()
  {
    $fields = array(
      array(
        'uid' => 'token_appid',
        'label' => 'UpNext API id',
        'section' => 'api',
        'type' => 'text',
      ),
      array(
        'uid' => 'token_appkey',
        'label' => 'UpNext API key',
        'section' => 'api',
        'type' => 'text',
      ),
      array(
        'uid' => 'base_uri',
        'label' => 'UpNext Base URL',
        'section' => 'api',
        'type' => 'text',
        'supplemental' => 'Include trailing slash',
      ),
      array(
        'uid' => 'google_api_maps_embed',
        'label' => 'Maps Embed API-key',
        'section' => 'google_api',
        'type' => 'text',
        'supplemental' => 'Get API key at https://console.developers.google.com/apis',
      ),
      array(
        'uid' => 'extension_company_information',
        'label' => 'Contact',
        'section' => 'extensions',
        'type' => 'checkbox',
        'options' => array(
          'true' => 'Enable replacement company information',
        ),
      ),
      array(
        'uid' => 'company_contact',
        'section' => 'extensions',
        'supplemental' => 'Format (company-number):(phonenumber):(e-mail)',
        'type' => 'textarea',
      ),
      array(
        'uid' => 'extension_spare_list',
        'label' => 'Spare list',
        'section' => 'extensions',
        'type' => 'checkbox',
        'options' => array(
          'true' => 'Enable spare list when event is full',
        ),
      ),
      array(
        'uid' => 'extension_spare_list_link',
        'section' => 'extensions',
        'type' => 'text',
        'supplemental' => 'Relative URL starting with slash /',
      ),
      array(
        'uid' => 'extension_show_location',
        'label' => 'Location',
        'section' => 'extensions',
        'type' => 'checkbox',
        'options' => array(
          'true' => 'Enable location modal list events',
        ),
      ),
      array(
        'uid' => 'detail_alias_prefix',
        'label' => 'Alias prefix',
        'section' => 'page',
        'type' => 'text',
        'supplemental' => 'Without trailing slash.',
      ),
      array(
        'uid' => 'detail_page_title',
        'label' => 'Title page',
        'section' => 'page',
        'type' => 'text',
        'supplemental' => '!title for event name',
      ),
      array(
        'uid' => 'subscribe_form_redirect',
        'label' => 'Node ID success page',
        'section' => 'page',
        'type' => 'text',
      ),
      array(
        'uid' => 'subscribe_form_checkbox',
        'label' => 'Checkbox label',
        'section' => 'labels',
        'type' => 'text',
      ),
      array(
        'uid' => 'subscribe_form_checkbox_av',
        'label' => 'Checkbox label av',
        'section' => 'labels',
        'type' => 'text',
      ),
      array(
        'uid' => 'invitation_text',
        'label' => 'Invitation text',
        'section' => 'text',
        'type' => 'editor',
      ),
      array(
        'uid' => 'registration_full',
        'label' => 'Registration full',
        'section' => 'text',
        'type' => 'editor',
      ),
      array(
        'uid' => 'unsubscribe_success',
        'label' => 'Unsubscribe succes message',
        'section' => 'text',
        'type' => 'editor',
      ),
      array(
        'uid' => 'subscribe_form_before_text',
        'label' => 'Default text before subscribe form',
        'section' => 'text',
        'type' => 'editor',
      ),
    );
    foreach ($fields as $field) {
      add_settings_field($field['uid'], $field['label'], array($this, 'field_callback'), 'upnext_fields', $field['section'], $field);
      register_setting('upnext_fields', $field['uid']);
    }
  }

  /**
   * Fields callback.
   *
   * @param $arguments
   *
   * @since    1.0.0
   */
  public function field_callback($arguments)
  {

    $value = get_option($arguments['uid']);
    switch ($arguments['type']) {
      case 'text':
      case 'password':
      case 'number':
        printf('<input size="60" name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], (isset($arguments['placeholder'])) ? $arguments['placeholder'] : '', $value);
        break;
      case 'textarea':
        printf('<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="100">%3$s</textarea>', $arguments['uid'], (isset($arguments['placeholder'])) ? $arguments['placeholder'] : '', $value);
        break;
      case 'editor':
        printf(wp_editor(
          html_entity_decode($value),
          $arguments['uid'],
          array('textarea_name' => $arguments['uid'])
        ));
      case 'select':
      case 'multiselect':
        if (!empty ($arguments['options']) && is_array($arguments['options'])) {
          $attributes = '';
          $options_markup = '';
          foreach ($arguments['options'] as $key => $label) {
            $options_markup .= sprintf('<option value="%s" %s>%s</option>', $key, selected($value[array_search($key, $value, true)], $key, false), $label);
          }
          if ($arguments['type'] === 'multiselect') {
            $attributes = ' multiple="multiple" ';
          }
          printf('<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup);
        }
        break;
      case 'radio':
      case 'checkbox':
        if(empty($value)){
          $value = array();
        }
        if (!empty ($arguments['options']) && is_array($arguments['options'])) {
          $options_markup = '';
          $iterator = 0;
          foreach ($arguments['options'] as $key => $label) {
            $iterator++;
            $options_markup .= sprintf('<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked($value[array_search($key, $value, true)], $key, false), $label, $iterator);
          }
          printf('<fieldset>%s</fieldset>', $options_markup);
        }
        break;
    }
    if ($helper = (isset($arguments['helper'])) ? $arguments['helper'] : '') {
      printf('<span class="helper"> %s</span>', $helper);
    }
    if ($supplemental = (isset($arguments['supplemental'])) ? $arguments['supplemental'] : '') {
      printf('<p class="description">%s</p>', $supplemental);
    }
  }
}
