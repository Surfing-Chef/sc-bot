<?php

$start = "http://localhost/sc-bot/sites.html";

require_once("parseFunctions.php");

// Import JSON file
$sites_json = file_get_contents('http://localhost/sc-bot/sites.json');

// Convert JSON to array
$sites_arr = json_decode($sites_json, true);

// Check age of page storing json data,
// older than 24hr delte and creat a new one.
// If not older than 24 hrs, abort.

// FUNCTION to get site header response code.
function get_http_response_code($site_url) {

  $headers = get_headers($site_url);
  return substr($headers[0], 9, 3);

}

// FUNCTION to get details of site
function get_details($site_name, $site_url){
  $site_data = array();

  switch ($site_name) {
    case "Epicurious" :
      // This function will take the site-url,
      // and parse the page, returning appropriate
      // data to be loaded into the json page.
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

  return
  '{
    "Title":"'.$site_data[0].'",
    "URL":"'.$site_data[1].'",
    "Title":"'.$site_data[2].'",
    "Feed Link":"'.$site_data[3].'",
    "Image Link":"'.$site_data[4].'"
  }';

  //file_put_contents('sites-info.json', print_r($b, true));
}
// END get_details()


function follow_links($sites_arr){

  foreach ($sites_arr as $site){
    // print_r($site);
    $site_name = $site['site-name'];
    $site_url =  $site['site-url'];

    // Get site headers response code
    $response_code = get_http_response_code($site_url);

    if ($response_code === "200"){
      echo get_details($site_name, $site_url).",\n";
    } else { // skip site if not responsive
      continue;
    }

  }

}
// END follow_links()

follow_links($sites_arr);
