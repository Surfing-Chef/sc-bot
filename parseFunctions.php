<?php
require "simple_html_dom.php";

// fopen and fwrite, the fclose

// Epicurious
function epicurious($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $feed_topic = $html->find("article[class=article-hero-featured-item] header strong", 0)->plaintext;
  $feed_title = $html->find("article[class=article-hero-featured-item] header H4", 0)->plaintext;
  $feed_url = $html->find("article[class=article-hero-featured-item] a", 0)->href;
  $feed_url = $site_url.substr($feed_url, 1);
  $feed_image = $html->find("article[class=article-hero-featured-item] div[class=photo-wrap] source[media=(min-width: 768px)]", 0)->srcset;
  $feed_image = explode(", ", $feed_image);
  $feed_image = $feed_image[0];

  // return array of data
  return array ( $site_name, $site_url, $feed_topic, $feed_title, $feed_url, $feed_image );
}

// Saveur
function saveur($site_name, $site_url){
  // Get HTML
  $html = file_get_html($site_url);

  // Parse HTML
  $img_att = "data-lgsrc";
  $feed_topic = $html->find("div[class=field-page-sections] H3 em", 0)->plaintext;
  $feed_title = $html->find("div[class=field-page-sections] H3 a", 0)->plaintext;
  $feed_url = $html->find("div[class=field-page-sections] H3 a", 0)->href;
  $feed_image = $html->find("div[class=field-image] a img", 0)->$img_att;

  // return array of data
  return array ( $site_name, $site_url, $feed_topic, $feed_title, $feed_url, $feed_image );

}
