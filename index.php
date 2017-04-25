<?php

$start = "http://localhost/sc-bot/sites.html";

require_once("parseFunctions.php");

// Import JSON file
$sites_json = file_get_contents('http://localhost/sc-bot/sites.json');

// Convert JSON to array
$sites_arr = json_decode($sites_json, true);

// Create array to hold all site data
$feed_container = array();

// FUNCTION to get site header response code.
function get_http_response_code($site_url) {

  $headers = get_headers($site_url);
  return substr($headers[0], 9, 3);

}

// FUNCTION to get details of site
function get_details($site_name, $site_url){
  $site_data = array();
  global $feed_container;

  switch ($site_name) {
    case "Epicurious" :
      // This function will take the site-url,
      // and parse the page, returning appropriate
      // data to be loaded into the cache page.
      $site_data = epicurious($site_name, $site_url);
      break;
    case "Saveur" :
      $site_data = saveur($site_name, $site_url);
      break;
    case "Food and Wine" :
      $site_data = foodandwine($site_name, $site_url);
      break;
    case "Food 52" :
      $site_data = food52($site_name, $site_url);
      break;
    case "Silver Surfers" :
      $site_data = silversurfers($site_name, $site_url);
      break;
    case "UCLA | Science and Food" :
      $site_data = ucla($site_name, $site_url);
      break;
    case "Chowhound" :
      $site_data = chowhound($site_name, $site_url);
      break;
    case "Foodtank" :
      $site_data = foodtank($site_name, $site_url);
      break;
    case "NPR | The Salt" :
     $site_data = thesalt($site_name, $site_url);
      break;
    case "Allrecipes" :
      $site_data = allrecipes($site_name, $site_url);
      break;
    case "Kitchn" :
      $site_data = kitchn($site_name, $site_url);
      break;
    case "Huffington Post | Taste" :
      $site_data = taste($site_name, $site_url);
      break;
  }

  $feed_container[] = array
  (
    $site_data[0],
    $site_data[1],
    $site_data[2],
    $site_data[3],
    $site_data[4]
  );

}
// END get_details()


function follow_links($sites_arr){
  global $feed_container;

  foreach ($sites_arr as $site){

    $site_name = $site['site-name'];
    $site_url =  $site['site-url'];

    echo $site_name."\n";
    // Get site headers response code
    $response_code = get_http_response_code($site_url);

    // check if site responds okay
    if ($response_code === "200"){
      get_details($site_name, $site_url);
    } else { // skip site if not responsive
      continue;
    }

  }
  // create, open, overwrite, and close cache file
  $target = "cache.txt";

  file_put_contents($target, print_r($feed_container, true));

}
// END follow_links()

function build_feed($sites_arr){

  $current_time = time();
  // How old (in seconds) before re-creating
  $target_time = 60;
  @$cache_time = filemtime("cache.txt");
  $age = $current_time - $cache_time;

  if (time() - $target_time > $cache_time || !$cache_time){
    // Too old
    follow_links($sites_arr);

  } else {
    // Too young
    exit;
  }

}
// END build_feed

// Build it!
build_feed($sites_arr);
