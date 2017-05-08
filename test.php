<?php
require "simple_html_dom.php";

$site_name = "Test Allrecipes";
$site_url = "http://allrecipes.com/";

function test($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML

  $img_att = "srcset";
  $feed_base = @$html->find("section[class=slider] article",0);
  $feed_title = @$feed_base->find("a div H3",0)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = @$feed_base->find("a",0)->href;
  $feed_image = @$feed_base->find("a img",0)->src;

  echo $site_name."\n";
  echo $site_url."\n";
  echo $feed_title."\n";
  echo $feed_url."\n";
  //echo $feed_image."\n";
}
  test($site_name, $site_url);
