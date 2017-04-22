<?php
require "simple_html_dom.php";

$site_name = "Saveur";
$site_url = "http://www.epicurious.com/";

function test($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $img_att = "data-lgsrc";
  $feed_topic = $html->find("div[class=field-page-sections] H3 em", 0)->plaintext;
  $feed_title = $html->find("div[class=field-page-sections] H3 a", 0)->plaintext;
  $feed_url = $html->find("div[class=field-page-sections] H3 a", 0)->href;
  $feed_image = $html->find("div[class=field-image] a img", 0)->img_att;


  echo $site_name."\n";
  echo $site_url."\n";
  echo $feed_topic."\n";
  echo $feed_title."\n";
  echo $feed_url."\n";
  echo $feed_image."\n";
}
  test($site_name, $site_url);
