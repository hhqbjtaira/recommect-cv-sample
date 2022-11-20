<?php
if (defined('PHP_VERSION_ID'))
  $version = PHP_VERSION_ID;
else
  $version = 0;

$rmt_ad_id_key = 'rmt_ad_id';
$rmt_sid_key = 'rmt_sid';

$rmt_ad_id_value = isset($_GET[$rmt_ad_id_key]) ? $_GET[$rmt_ad_id_key] : null;
$rmt_sid_value = isset($_GET[$rmt_sid_key]) ? $_GET[$rmt_sid_key] : null;

if (!$rmt_ad_id_value || !$rmt_sid_value) return;

$expires = date(strtotime('+90 day'));
$path = '/';
$samesite = 'lax';
$secure = true;

if ($version >= 70300) {
  $options = array("expires" => $expires, "path" => $path, "secure" => $secure, "samesite" => $samesite);

  if (isset($rmt_ad_id_key)) {
    $ad_id_cookie_key = "_{$rmt_ad_id_key}_{$rmt_ad_id_value}";
    setcookie($ad_id_cookie_key, $rmt_ad_id_value, $options);
  }

  if (isset($rmt_sid_key)) {
    $sid_cookie_key = "_{$rmt_sid_key}_{$rmt_ad_id_value}";
    setcookie($sid_cookie_key, $rmt_sid_value, $options);
  }
} else {
  $options = "{$path}; SameSite={$samesite}";

  if (isset($rmt_ad_id_key)) {
    $ad_id_cookie_key = "_{$rmt_ad_id_key}_{$rmt_ad_id_value}";
    setcookie($ad_id_cookie_key, $rmt_ad_id_value, $expires, $options, "", $secure);
  }

  if (isset($rmt_sid_key)) {
    $sid_cookie_key = "_{$rmt_sid_key}_{$rmt_ad_id_value}";
    setcookie($sid_cookie_key, $rmt_sid_value, $expires, $options, "", $secure);
  }
}
