<?php

$xml = new DOMDocument();
$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;
$xml->load('IconicOpmBands.xml');
$bands = $xml->getElementsByTagName('band');

$success = false;
$fields = [
    'bandCode', 'bandName', 'debut', 'hitSong', 'genres'
];

$emptyFields = [
    'bandCode' => '',
    'bandName' => '',
    'debut' => '',
    'hitSong' => '',
    'genres' => ''
];

$newBand = [
    'code' => '',
    'name' => '',
    'debut' => '',
    'hitSong' => '',
    'genres' => ''
];
