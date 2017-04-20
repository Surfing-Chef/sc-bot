<?php

$start = "http://localhost/sc-bot/test.html";

function follow_links($url){

  $doc = new DOMDocument();
  $doc->loadHTML(file_get_contents($url));

  $linklist = $doc->getElementsByTagName('a');

  foreach ($linklist as $link){

    $l =  $link->getAttribute("href");
    if (substr($l, 0, 1) == '/' && substr($l, 0, 2) != '//') {
      $l = parse_url($url)['scheme'] . "://" . parse_url($url)['host'] . $l;
    }

    echo $l . "\n";

  }

}

follow_links($start);
