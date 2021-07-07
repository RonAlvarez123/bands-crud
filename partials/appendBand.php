<?php

$bands[] = [
    'bandCode' => $bandsXml[$i]->getAttribute('bandCode'),
    'bandName' => $bandsXml[$i]->getElementsByTagName('bandName')->item(0)->nodeValue,
    'debut' => $bandsXml[$i]->getElementsByTagName('debut')->item(0)->nodeValue,
    'hitSong' => $bandsXml[$i]->getElementsByTagName('hitSong')->item(0)->nodeValue,
    'genres' => getGenres($bandsXml[$i]->getElementsByTagName("genre"))
];
