<?php
require "simple_html_dom.php";

$site_name = "Huffington Post | Taste";
$site_url = "http://www.huffingtonpost.com/section/taste";

function test($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $feed_base = $html->find("div[class=a-page__content__splash] section",0);
  $feed_title = $feed_base->find("H2 a", 0)->plaintext;
  $feed_url = $feed_base->find("H2 a", 0)->href;
  $feed_image = $feed_base->find("div[class=splash__image__wrapper] a img", 0)->src;

  echo $site_name."\n";
  echo $site_url."\n";
  echo $feed_title."\n";
  echo $feed_url."\n";
  echo $feed_image."\n";
}
  test($site_name, $site_url);
