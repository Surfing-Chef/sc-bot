<?php 

$start = "http://localhost/sc-bot/sites.html";

function get_details($url){

  $options = array(
    'http'=>array(
      'method'=>"GET",
      'headers'=>"User-Agent: sc-Bot/0.1\n"
    )
  );

  $context = stream_context_create($options);

  $doc = new DOMDocument();
  @$doc->loadHTML(@file_get_contents($url, false, $context));

  $title = @$doc->getElementsByTagName("title");
  $title = @$title->item(0)->nodeValue;

  $description = "";
  $keywords = "";
  $metas = $doc->getElementsByTagName("meta");
  for ( $i = 0; $i < $metas->length; $i++ ){
    $meta = $metas->item($i);

    if ($meta->getAttribute("property") == strtolower("og:site_name")){
      $title = $meta->getAttribute("content");
     }
  }

  return '{
    "Title":"'.$title.'",
    "URL":"'.str_replace("\\n","", $url).',"
  }';
}

function follow_links($url){

  $options = array(
    'http'=>array(
      'method'=>"GET",
      'headers'=>"User-Agent: sc-Bot/0.1\n"
    )
  );

  $context = stream_context_create($options);

  $doc = new DOMDocument();
  @$doc->loadHTML(@file_get_contents($url, false, $context));

  $linklist = @$doc->getElementsByTagName('a');

  foreach ($linklist as $link){

    $l =  $link->getAttribute("href");

    echo get_details($l). "\n";
  }
}

follow_links($start);
