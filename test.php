<?php
// require "simple_html_dom.php";
//
// $site_name = "epicy";
// $site_url = "http://www.foodandwine.com/";
//
// function test($site_name, $site_url){
//   // Get HTML
//   $html = file_get_html($site_url);
//
//   // Parse HTML
//   $img_att = "srcset";
//   $feed_base = $html->find("article[class=hero-feature]",0);
//   $feed_title = $feed_base->find("div[class=hero-feature__content] span",0)->plaintext;
//   $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
//   $feed_url = $feed_base->find("a[class=hero-feature__link]",0)->href;
//   $feed_image = $feed_base->find("a[class=hero-feature__link] source",0)->$img_att;
//   $feed_image = substr(trim($feed_image), 0, -3);
//
//   echo $site_name."\n";
//   echo $site_url."\n";
//   echo $feed_title."\n";
//   echo $feed_url."\n";
//   echo $feed_image."\n";
// }
//   test($site_name, $site_url);

// function to create random numbers
function randomizer($how_many, $of_how_many){
  $num_array = array();

  while(count($num_array)<$how_many){
    $num = round(rand(0, $of_how_many-1));
    if(!in_array($num,$num_array)){
      $num_array[] = $num;
    } else {
      continue;
    }
  }
  print_r($num_array);
}

randomizer(6,12);
