<?php

/**
 * Config API
 */
class ConfigApi {

  /**
   * Connect.
   */
  public function connect() {
    $event = new EventFunctions();
    $event->setTokens(get_option('token_appid'), get_option('token_appkey'));
    $event->setBaseUri(get_option('base_uri'));
    return $event;
  }

}
