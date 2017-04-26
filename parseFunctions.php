<?php
require "simple_html_dom.php";

// fopen and fwrite, the fclose

// Epicurious
function epicurious($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $feed_base = $html->find("article[class=article-hero-featured-item]",0);
  $feed_title = $feed_base->find("header H4", 0)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->find("a", 0)->href;
  $feed_url = $site_url.substr($feed_url, 1);
  $feed_image = $html->find("div[class=photo-wrap] source[media=(min-width: 768px)]", 0)->srcset;
  $feed_image = explode(", ", $feed_image);
  $feed_image = $feed_image[0];

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image);

}

// Saveur
function saveur($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $img_att = "data-lgsrc";
  $feed_base =$html->find("div[class=field-page-sections]",0);
  $feed_title = $feed_base->find("H3 a", 0)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->find("H3 a", 0)->href;
  $feed_image = $html->find("div[class=field-image] a img", 0)->$img_att;

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}

// Food and Wine
function foodandwine($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $img_att = "srcset";
  $feed_base = $html->find("article[class=hero-feature]",0);
  $feed_title = $feed_base->find("div[class=hero-feature__content] span",0)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->find("a[class=hero-feature__link]",0)->href;
  $feed_image = $feed_base->find("a[class=hero-feature__link] source",0)->$img_att;
  $feed_image = substr(trim($feed_image), 0, -3);

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}

// Food 52
function food52($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $img_att = "data-pin-media";
  $feed_base = $html->find("div[class=home-grid]",1);
  $feed_title = $feed_base->find(".home-tile a", 1)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->find(".home-tile a", 0)->href;
  $feed_url = $site_url.substr($feed_url, 1);
  $feed_image = $feed_base->find(".home-tile a img", 0)->$img_att;

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}

// Silver Surfers
function silversurfers($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $feed_base = $html->find("div[class=listing_box large]",0);
  $feed_title = $feed_base->find("div[class=abs_box] a",0)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->find("div[class=abs_box] a",0)->href;
  $feed_image = $feed_base->find("div[class=bg_img]", 0)->style;
  $feed_image = substr($feed_image, 21);
  $feed_image = substr(trim($feed_image), 0, -2);

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}

// UCLA
function ucla($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $img_att = "data-large-file";
  $feed_base = $html->find("#content article",0);
  $feed_title = $feed_base->find("header H1 a",0)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->find("header H1 a",0)->href;
  $feed_image = $feed_base->find("div[class=entry-thumbnail] a img", 0)->$img_att;

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}

// Chowhound
function chowhound($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $img_att = "data-src";
  $feed_base = $html->find("div[class=fr_ftp_promo_box]",0);
  $feed_title = $feed_base->find("div[class=fr_ftp_txt] H2 a", 0)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->find("div[class=fr_ftp_txt] H2 a", 0)->href;
  $feed_image = $feed_base->find("figure img", 0)->$img_att;

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}

// Food Tank
function foodtank($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $img_att = "data-original";
  $feed_base = $html->find("article figure a", 0);
  $feed_title = $feed_base->title;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->href;
  $feed_image = $html->find("article figure a img", 0)->$img_att;

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}

// The Salt
function thesalt($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $feed_base = $html->find("#overflow article[class=has-image]", 0);
  $feed_title = $feed_base->find("div[class=item-info] H2 a", 0)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->find("div[class=item-info] H2 a", 0)->href;
  $feed_image = $feed_base->find("div[class=imagewrap] a img", 0)->src;

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}

// Allrecipes
function allrecipes($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $feed_base = $html->find("article[class=slider__slide]", 0);
  $feed_title = $feed_base->find("div[class=slider__text] H3", 0)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->find("a", 0)->href;
  $feed_image = $feed_base->find("a img", 0)->src;

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}

// Kitchn
function kitchn($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $feed_base = $html->find("div[class=TeaserGrid__item] a",0);
  $feed_title = $feed_base->find("div[class=StandardTeaser__body] span",1)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->href;
  $feed_image = $feed_base->find("div[class=StandardTeaser__picture] img",0)->src;

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}

// Huffington Post Taste
function taste($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $feed_base = $html->find("div[class=a-page__content__splash] section",0);
  $feed_title = $feed_base->find("H2 a", 0)->plaintext;
  $feed_title = trim(preg_replace('/\s\s+/', ' ', $feed_title));
  $feed_url = $feed_base->find("H2 a", 0)->href;
  $feed_image = $feed_base->find("div[class=splash__image__wrapper] a img", 0)->src;

  // Return array of data
  return array ( $site_name, $site_url, $feed_title, $feed_url, $feed_image );

}
