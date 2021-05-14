<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link Driessen
 * @since 1.0.0
 *
 * @package Upnext
 * @subpackage Upnext/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package Upnext
 * @subpackage Upnext/public
 * @author Driessen Groep <webmasters@driessengroep.nl>
 */
class Upnext_Public {

  /**
   * The event id from URL.
   *
   * @since 1.1.0
   * @access public
   * @var string
   */
  public $eventIdUrl;

  /**
   * The event detail.
   *
   * @since 1.0.0
   * @access private
   * @var string
   */
  public $event;

  /**
   * The ID of this plugin.
   *
   * @since 1.0.0
   * @access private
   * @var string
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since 1.0.0
   * @access private
   * @var string
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since 1.0.0
   *
   * @param string $plugin_name
   *   The name of the plugin.
   * @param string $version
   *   The version of this plugin.
   */
  public function __construct($plugin_name, $version) {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
    $this->paramEvent = '';
  }

  /**
   * Initialize functions.
   *
   * @since 1.1.0
   */
  public function initDetail() {
    $this->getEventIdUrl();
  }

  /**
   * Get Event ID from URL.
   *
   * @return string
   *
   * @since 1.0.0
   */
  public function getEventIdUrl() {
    $eventID = get_query_var('event');
    $tmp = explode('-', $eventID);
    $eventID = end($tmp);
    $this->eventIdUrl = $eventID;
  }

  /**
   * Initialize functions.
   *
   * @since 1.1.0
   */
  public function setDetail($detail) {
    $this->event = $detail;
  }

  /**
   * Register the stylesheets for the public-facing side of the site.
   *
   * @since 1.0.0
   */
  public function enqueue_styles() {

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
    // wp_enqueue_style($this->plugin_name . '-grid', plugin_dir_url(__FILE__) . 'css/boostrap-grid.min.css', [], $this->version, 'all');
    wp_enqueue_style($this->plugin_name . '-public', plugin_dir_url(__FILE__) . 'css/upnext-public.css', [], $this->version, 'all');

  }

  /**
   * Register the JavaScript for the public-facing side of the site.
   *
   * @since 1.0.0
   */
  public function enqueue_scripts() {

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

    wp_enqueue_script($this->plugin_name . '-validate', plugin_dir_url(__FILE__) . 'js/jquery-validate/jquery.validate.min.js', ['jquery'], $this->version, TRUE);
    wp_enqueue_script($this->plugin_name . '-messages_nl', plugin_dir_url(__FILE__) . 'js/jquery-validate/localization/messages_nl.min.js', ['jquery'], $this->version, TRUE);
    wp_enqueue_script($this->plugin_name . '-public', plugin_dir_url(__FILE__) . 'js/upnext-public.js', ['jquery'], $this->version, TRUE);

  }

  /**
   * Rewrite the event detail pages.
   *
   * @since 1.0.0
   */
  public function event_rewrite_basic() {
    global $wp_rewrite;
    add_rewrite_rule(get_option('detail_alias_prefix') . '/([^/]+)/?$', 'index.php?event=$matches[1]', 'top');
  }

  /**
   * Set template based on query vars.
   *
   * @since 1.0.0
   */
  public function event_prefix_url_rewrite_templates() {

    if (get_query_var('event')) {
      add_filter('template_include', function () {
        return get_template_directory() . '/single-event.php';
      });
    }

  }

  /**
   * Set query vars.
   *
   * @since 1.0.0
   */
  public function event_add_query_vars_filter($vars) {
    $vars[] = "event";
    $vars[] = "guid";
    return $vars;
  }

  /**
   * Remove participant with guid from query
   * Shortcode for event_remove_participant.
   *
   * @since 1.0.0
   */
  public function event_remove_participant_shortcode() {
    $eventConnector = new ConfigApi();
    $eventConnector = $eventConnector->connect();
    $guid = get_query_var('guid');

    if (!empty($guid)) {
      $eventConnector->removeParticipant($guid);
    }

    $response = '';

    // If admin show status.
    if (current_user_can('administrator')) {
      $response .= 'Admin message: ';
      if ($eventConnector->http_code == 200) {
        $response .= 'Subscription removed.';
      }
      else {
        $response .= 'No subscription found.';
      }
      $response .= 'HTTP-code: ' . $eventConnector->http_code;
    }
    // Always success for the visitor.
    $response .= get_option('unsubscribe_success');
    return $response;
  }

  /**
   * Shortcode events.
   *
   * @since 1.0.0
   */
  public function upnext_events($attr) {
    $located = locate_template('includes/events/shortcode-upnext-events.php');
    if (!empty($located)) {
      ob_start();
      require_once locate_template('includes/events/shortcode-upnext-events.php', FALSE, FALSE);
      return ob_get_clean();
    }
  }

  /**
   * Shortcode rootevents.
   *
   * @since 1.0.0
   */
  public function upnext_rootevents($attr) {
    $located = locate_template('includes/events/shortcode-upnext-rootevents.php');
    if (!empty($located)) {
      ob_start();
      require_once locate_template('includes/events/shortcode-upnext-rootevents.php', FALSE, FALSE);
      return ob_get_clean();
    }
  }

  /**
   * Form process.
   *
   * @since 1.0.0
   */
  public function handle_register_event_person() {

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    $eventConnector = new ConfigApi();
    $eventConnector = $eventConnector->connect();
    $eventConnector->request('POST', 'Event/PostParticipant?sendConfirmation=true', $_POST);

    if (!isset($_POST['_mynonce']) || !wp_verify_nonce($_POST['_mynonce'], 'register_event_person')) {
      exit;
    }

    if ($eventConnector->http_code == 201) {
      wp_redirect(get_permalink(get_option('subscribe_form_redirect')));
      die();
    }
    else {
      wp_redirect($_POST['_wp_http_referer']);
      die();
    }

  }

  /**
   * Set canonical.
   *
   * @return string
   *
   * @since 1.0.0
   */
  public function wpseo_canonical($canonical) {
    if (get_query_var('event')) {
      return get_home_url() . $_SERVER['REQUEST_URI'];
    }
    else {
      return $canonical;
    }
  }

  /**
   * Remove next.
   *
   * @return string
   *
   * @since 1.0.0
   */
  public function wpseo_next_rel_link() {
    if (get_query_var('event')) {
      return FALSE;
    }
  }

  /**
   * Remove default image.
   *
   * @return string
   *
   * @since 1.0.0
   */
  public function custom_wpseo_opengraph_image($image) {
	  if (get_query_var('event')) {
		  $this->setUpNextDetail();
		  $image = 'https://decmapi.driessen.nl/test/signal/mediadetailsimage/' . $this->event->HeaderId;
		  return $image;
	  }
    else {
      return $image;
    }
  }

  /**
   *
   */
  public function getText($text) {
  	if (get_query_var('event') && !empty($this->event) && get_option($text)) {
	    $id = $this->event->Id;
	    $title = $this->event->Name;
	    $date = strftime( "%A %e %B %Y", $this->event->StartDateTime );
	    $arrayTokens = ['[id]', '[title]', '[date]'];
	    $arrayValues = [$id, $title, $date];
	    return str_ireplace($arrayTokens, $arrayValues, get_option($text));
    }
  }

  /**
   * Show text before subscribe form.
   *
   * @return string
   *
   * @since 1.1.0
   */
  public function get_subscribe_form_text($businessUnitId){
    if(get_option('extension_company_information')) {
      $businessUnitId = sanitize_title($businessUnitId);
      $subscribeText = get_option('subscribe_form_before_text');
      $phoneListLines = array_filter(explode(PHP_EOL, get_option('company_contact')));

      // Make array from textlines.
      if (!empty($phoneListLines)) {
        foreach ($phoneListLines as $line) {
          $line = str_replace(["\n", "\r"], '', $line);
          $split = explode(":", $line);
          if ($split[0] == $businessUnitId) {
            $arrayTokens = ['[phone]', '[email]'];
            $arrayValues = [$split[1], $split[2]];
            return str_ireplace($arrayTokens, $arrayValues, $subscribeText);
          }
        }
      }
      return false;
    }
    return get_option('subscribe_form_before_text');;
  }

  /**
   * Set description.
   *
   * @return string
   *
   * @since 1.0.0
   */
  public function wpseo_metadesc($description) {
    if (get_query_var('event') && !empty($this->event)) {
      return strip_tags($this->event->ShortDescription);
    }
    else {
      return $description;
    }
  }

  /**
   * Set UpNext detail.
   *
   * @since 1.0.0
   */
  public function setUpNextDetail() {
    if (get_query_var('event') && empty($this->event)) {
      $this->getEventIdUrl();
      $eventConnector = new ConfigApi();
      $eventConnector = $eventConnector->connect();
      $this->event = $eventConnector->request('GET', 'Event/EventDetails/' . $this->eventIdUrl);
      if ($eventConnector->http_code != 200) {
        status_header(404);
      }
    }
  }

  /**
   * Set UpNext detail.
   *
   * @since 1.0.0
   */
  public function wp_init() {
    $this->setUpNextDetail();
    if (empty($this->event) && get_query_var('event')) {
      status_header(404);
      nocache_headers();
      include(get_query_template('404'));
      die();
    }

  }

  /**
   * Custom Title.
   *
   * @param $title
   *
   * @return string
   *
   * @since 1.0.0
   */
  public function custom_seo_title($title) {
    if (get_query_var('event') && !empty($this->event)) {
      $search_replace = [
        '!title' => $this->event->Name,
      ];
      $title = str_replace(array_keys($search_replace), array_values($search_replace), get_option('detail_page_title'));
    } else if(get_query_var('event') && empty($this->event)){
      $title = __( 'Page not found' );
    }
    return $title;
  }

  /**
   * When DetailLink is used and IsMainChannel is
   *  not this channel use the DetailLink.
   *
   * @param $event
   *
   * @return string
   *
   * @since 1.1.0
   */
  public function getDetailLink($event) {
    if (isset($event->DetailLink) && !$event->IsMainChannel) {
      $eventLink = $event->DetailLink;
    }
    else {
      $eventLink = "/" . get_option('detail_alias_prefix') . "/" . sanitize_title($event->Name) . "-" . $event->Id;
    }
    return $eventLink;
  }

}
