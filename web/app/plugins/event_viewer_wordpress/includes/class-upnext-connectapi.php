<?php

/**
 * ConnectApi
 */
class ConnectApi {

  /**
   * Default variables.
   */
  public $uri;

  public $postdata;

  public $apiInfo;

  public $action;

  public $signature;

  public $requestmethod;

  public $timestamp;

  public $http_code;

  public $debug;

  public $base_uri;

  public $token_appid;

  public $token_appkey;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->timestamp = time();
    $this->debug = FALSE;
  }

  /**
   * Set tokens.
   *
   * @param string $appid
   * @param string $appkey
   */
  public function setTokens($appid, $appkey) {
    $this->token_appid = $appid;
    $this->token_appkey = $appkey;
  }

  /**
   * Set base_uri.
   *
   * @param string $url
   *   URL for request.
   */
  public function setBaseUri($url) {
    $this->base_uri = $url;
  }

  /**
   * Get http_code.
   *
   * @return string http_code
   *   Status http.
   */
  public function getHttpCode() {
    return $this->http_code;
  }

  /**
   * Enable debug.
   *
   *   $_POST.
   */
  public function enableDebug() {
    $this->debug = TRUE;
  }

  /**
   * Curl Call.
   *
   * @return json $APIResult
   */
  public function request($method, $endpoint, $body = NULL) {

    $this->setData($body);
    $this->setURL($this->base_uri . $endpoint);
    $this->setRequestMethod($method);
    $this->authenticate();

    // Set headers.
    $headers = [];
    $headers[] = "Authorization: amx {$this->token_appid}:{$this->signature}:{$this->timestamp}";
    $headers[] = "Content-Type: application/json";

    // Start curl.
    $curlHandle = curl_init();
    curl_setopt($curlHandle, CURLOPT_COOKIESESSION, TRUE);
    curl_setopt($curlHandle, CURLOPT_URL, $this->uri);
    curl_setopt($curlHandle, CURLOPT_FRESH_CONNECT, FALSE);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
    curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 10);

    // Request method DELETE.
    if ($this->requestmethod == 'DELETE') {
      curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "DELETE");
    }

    // Request method POST.
    if (!empty($this->postdata) && count($this->postdata) > 0 && $this->requestmethod != 'GET' && $this->requestmethod != 'DELETE') {
      curl_setopt($curlHandle, CURLOPT_POST, 1);
      curl_setopt($curlHandle, CURLOPT_POSTFIELDS, json_encode($this->postdata));
    }

    curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curlHandle, CURLOPT_UNRESTRICTED_AUTH, 0);
    curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curlHandle, CURLOPT_FAILONERROR, TRUE);
    curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, FALSE);

    // Set curl values.
    $returnValue = curl_exec($curlHandle);

    // Combine results to json.
    $APIResult = [];
    $APIResult['post'] = $this->postdata;
    $APIResult['error'] = curl_error($curlHandle);
    $APIResult['info'] = curl_getinfo($curlHandle);
    $this->apiInfo = $APIResult;
    $this->http_code = $APIResult['info']['http_code'];

    // Try executing the curl request again when http_code is empty.
    $tryAgain = TRUE;
    if(empty($APIResult['info']['http_code']) && $tryAgain == TRUE){
      $returnValue = curl_exec($curlHandle);
      $tryAgain = FALSE;
      trigger_error($APIResult['error']);
    }

    // Debug.
    if ($this->debug) {
      echo "<pre>";
      print_r($APIResult);
      print_r(json_decode($returnValue));
      echo "</pre>";
    }

    return json_decode($returnValue);
  }

  /**
   * Set post data.
   *
   * @param array $postdata
   *   $_POST.
   */
  public function setData($postdata) {
    $this->postdata = $postdata;
  }

  /**
   * Set uri.
   *
   * @param string $url
   *   URL for request.
   */
  public function setURL($url) {
    $this->uri = $url;
  }

  /**
   * Set requestmethod.
   *
   * @param string $requestmethod
   *   POST, GET or DELETE.
   */
  public function setRequestMethod($requestmethod) {
    $this->requestmethod = $requestmethod;
  }

  /**
   * Set and generate authorisation values.
   *
   * @param string $appid
   * @param string $apikey
   */
  public function authenticate() {

    $data = NULL;

    // Request method.
    if ($this->requestmethod == "GET" || $this->requestmethod == "DELETE") {
      if ($this->postdata != '') {
        $this->uri .= "?" . http_build_query($this->postdata);
      }
    }
    else {
      $data = base64_encode(md5(json_encode($this->postdata), TRUE));
    }

    // Generate signature.
    $sigUri = strtolower(preg_replace('#^https?#', '', $this->uri));
    $signatureSet = $this->token_appid . $this->requestmethod . $sigUri . $this->timestamp . $data;
    $this->signature = base64_encode(hash_hmac('sha256', $signatureSet, $this->token_appkey, TRUE));

  }

}
