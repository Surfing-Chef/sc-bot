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
      echo "run Food and Wine function"."\n";
      break;
    // case "Food 52" :
    //   echo "run Food 52 function"."\n";
    //   break;
    // case "Silver Surfers" :
    //   echo "run Silver Surfers function"."\n";
    //   break;
    // case "UCLA | Science and Food" :
    //   echo "run UCLA function"."\n";
    //   break;
    // case "Chowhound" :
    //   echo "run Chowhound function"."\n";
    //   break;
    // case "Foodtank" :
    //   echo "run Foodtank function"."\n";
    //   break;
    // case "NPR | The Salt" :
    //   echo "run NPR function"."\n";
    //   break;
    // case "Allrecipes" :
    //   echo "run Allrecipes function"."\n";
    //   break;
    // case "The Kitchen" :
    //   echo "run Kitchen function"."\n";
    //   break;
    // case "Huffington Post | Taste" :
    //   echo "run Taste function"."\n";
    //   break;
    // case "101 Cookbooks" :
    //   echo "run 101 Cookbooks function"."\n";
    //   break;
  }

  return '{
    "Title":"'.$site_data[0].'",
    "URL":"'.$site_data[1].'",
    "Topic":"'.$site_data[2].'",
    "Title":"'.$site_data[3].'",
    "Feed Link":"'.$site_data[4].'",
    "Image Link":"'.$site_data[5].'"
  }';

  //file_put_contents('sites-info.json', print_r($b, true));
}
// END get_details()


function follow_links($sites_arr){

  foreach ($sites_arr as $site){
    // print_r($site);
    $site_name = $site['site-name'];
    $site_url =  $site['site-url'];

    echo get_details($site_name, $site_url). "\n";
  }

}
// END follow_links()

follow_links($sites_arr);
